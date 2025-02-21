<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Code\StoreCodeRequest;
use App\Models\Code;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $codes = Code::with(['user'])
            ->paginate(10);

        return view('admin.code.index', compact('codes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCodeRequest $request)
    {
        $numberOfCodes = $request->input('number_of_codes');

        $existingCodes = Code::pluck('code')->toArray();
        $codes = [];

        while (count($codes) < $numberOfCodes) {
            $code = str_pad(mt_rand(0, 99999999), 8, '0', STR_PAD_LEFT);

            if (!in_array($code, $existingCodes) && !in_array($code, array_column($codes, 'code'))) {
                $codes[] = ['code' => $code];
            }
        }

        Code::insert($codes);

        return redirect()->route('admin.codes.index')->with('success', __('message.Code Added Successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $code = Code::findOrFail($id);
        $code->update([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
        return response()->json(['code' => $code]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $code = Code::findOrFail($id);

        $code->delete();

        return redirect()->route('admin.codes.index')->with('success', __('message.Code Deleted Successfully'));
    }
    public function destroyAjax(string $id)
    {
        $code = Code::findOrFail($id);
        $code->delete();

        return response()->json(['success' => __('message.Code Deleted Successfully')]);
    }

    public function exportCodes()
    {
        $codes = Code::with('user:name,email,phone')
            ->select('id', 'code', 'start_date', 'end_date', 'user_id')
            ->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $sheet->setCellValue('A1', 'Code');
        $sheet->setCellValue('B1', 'Start Date');
        $sheet->setCellValue('C1', 'End Date');
        $sheet->setCellValue('D1', 'User Name');
        $sheet->setCellValue('E1', 'User Email');
        $sheet->setCellValue('F1', 'User Phone');

        // Fill data
        $row = 2;
        foreach ($codes as $code) {
            $sheet->setCellValue('A' . $row, $code->code);
            $sheet->setCellValue('B' . $row, $code->start_date);
            $sheet->setCellValue('C' . $row, $code->end_date);
            $sheet->setCellValue('D' . $row, optional($code->user)->name);
            $sheet->setCellValue('E' . $row, optional($code->user)->email);
            $sheet->setCellValue('F' . $row, optional($code->user)->phone);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'codes.xlsx';

        return new StreamedResponse(function () use ($writer) {
            $writer->save('php://output');
        }, 200, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => "attachment; filename=\"$fileName\"",
        ]);
    }
}
