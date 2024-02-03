<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Mail\CsvComplete;
use Illuminate\Support\Facades\Mail;
class CustomerController extends Controller
{
    public function index(){
        return view('index');
    }
    public function customer(){
        return view('customer');
    }

    public function import(Request $request)
{

    $file = $request->file('file');
    $fileContents = file($file->getPathname());

    $csvData = array_map('str_getcsv', file($file));
    // array_shift($csvData);
    foreach ($csvData as $row) {
        Customer::create([
            'branch_id' => $row[0],
            'first_name' => $row[1],
            'last_name' => $row[2],
            'email' => $row[3],
            'phone' => $row[4],
            'gender' => $row[5],

        ]);
    }
    $data='Csv Uploaded';
    Mail::to('career@akaarit.com')->send(new CsvComplete($data));

    return redirect()->back()->with('success', 'CSV file imported successfully.');
}
public function customer_list(Request $request)
{

        $gender = $request->gender;
        $per_page_data =  15;
        $branch = $request->branch;
        $data = Customer::query();
        if ($request->get("gender")) {
            $data = $data->where("gender", $request->get("gender"));
        }
        if ($request->get("branch")) {
            $data = $data->where("branch_id", 'like', '%' . $request->get("branch") . '%');
        }
        $data=$data->paginate($per_page_data);

        $output = '';
        foreach ($data as $customer) {
            $output .= '
            <tr>
            <td>' . $customer->branch_id . '</td>
            <td>' . $customer->first_name . '</td>
            <td>' . $customer->last_name . '</td>
            <td>' . $customer->email . '</td>
            <td>' . $customer->phone . '</td>
            <td>' . $customer->gender . '</td>
            </tr>

            ';
        }
        $links = $data->links();
        return [
            'customers' => $output,
            'links' => (string)$links,
        ];
        }
}






