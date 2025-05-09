<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use App\Models\Positions;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employees::where('status', 1)->get();
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $positions = Positions::all();
        return view('employees.create', compact('positions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'address' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|string|max:20',
            'position_id' => 'required|integer',
            'active' => 'string|default:S',
            'status' => 'boolean|default:1',
        ]);

        $employee = Employees::create([
            'name' => $data['name'],
            'address' => $data['address'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'position_id' => $data['position_id'],
            'active' => 'S',
            'status' => 1
        ])->save();


        if ($employee) return redirect()->route('employees')->with('success', 'Employee created successfully.');
        else return redirect()->route('employees')->with('error', 'Failed to create employee.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $employee = Employees::find($id);
        
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $employee = Employees::find($id);
        $positions = Positions::all();
        
        return view('employees.edit', compact('employee', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'address' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|string|max:20',
            'position_id' => 'required|integer',
            'active' => 'required|string|max:1',
            'status' => 'boolean|default:1',
        ]);

        $employee = Employees::find($id);
        $employee->update([
            'name' => $data['name'],
            'address' => $data['address'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'position_id' => $data['position_id'],
            'active' => $data['active'],
            'status' => 1
        ]);

        if ($employee) return redirect()->route('employees')->with('success', 'Employee updated successfully.');
        else return redirect()->route('employees')->with('error', 'Failed to update employee.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $employee = Employees::find($id);
        $employee->update(['status' => 0]);
        if ($employee) return redirect()->route('employees')->with('success', 'Employee deleted successfully.');
        else return redirect()->route('employees')->with('error', 'Failed to delete employee.');
    }

    public function pdf()
    {
        $employees = Employees::where('status', 1)->get();
        
        $pdf = FacadePdf::loadView('employees.reports.employees', compact('employees'));
        return $pdf->stream('employees_report.pdf');
    }
    public function pdfId($id)
    {
        $employee = Employees::find($id);
        
        $pdf = FacadePdf::loadView('employees.reports.employee', compact('employee'));
        return $pdf->stream('employee_report.pdf');
    }
    public function card($id)
    {
        $employee = Employees::find($id);
        
        $pdf = FacadePdf::loadView('employees.reports.card', compact('employee'));
        return $pdf->stream('employee_card.pdf');
    }

    public function doc()
    {
        $employees = Employees::where('status', 1)->get();

        $phpWord = new PhpWord();
        $section = $phpWord->addSection();

        # Title
        $section->addText(
            'Reporte de Empleados', 
            [
                'name' => 'Arial',
                'size' => 16,
                'bold' => true,
            ]
        );

        # Generate date
        $section->addText(
            'Fecha de Generación: ' . now()->format('d/m/Y H:i:s'), 
            [
                'name' => 'Arial',
                'size' => 12,
                'bold' => true,
            ]
        );

        $section->addTextBreak(2);

        # Table
        $table = $section->addTable([
            'borderSize' => 6,
            'borderColor' => '999999',
            'cellMargin' => 80,
        ]);

        # Header
        $table->addRow();
        $table->addCell(1000)->addText('ID', ['bold' => true]);
        $table->addCell(1000)->addText('Nombre', ['bold' => true]);
        $table->addCell(1000)->addText('Dirección', ['bold' => true]);
        $table->addCell(1000)->addText('Email', ['bold' => true]);
        $table->addCell(1000)->addText('Teléfono', ['bold' => true]);
        $table->addCell(1000)->addText('Puesto', ['bold' => true]);
        $table->addCell(1000)->addText('Activo', ['bold' => true]);

        # Data
        foreach ($employees as $employee) {
            $table->addRow();
            $table->addCell(1000)->addText($employee->id);
            $table->addCell(1000)->addText($employee->name);
            $table->addCell(1000)->addText($employee->address);
            $table->addCell(1000)->addText($employee->email);
            $table->addCell(1000)->addText($employee->phone);
            $table->addCell(1000)->addText($employee->position->name);
            $table->addCell(1000)->addText($employee->active == 'S' ? 'Sí' : 'No');
        }

        # Save file
        $fileName = 'reporte_empleados_'. date('d/m/Y_H:i:s').'.docx';
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');

        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');
        
        $objWriter->save('php://output');
        exit;
    }

    public function xlsx()
    {
        $employees = Employees::where('status', 1)->get();
        $headers = [
            'ID',
            'Nombre',
            'Dirección',
            'Email',
            'Teléfono',
            'Puesto',
            'Activo'
        ];
        $data = [];
        foreach ($employees as $employee) {
            $data[] = [
                $employee->id,
                $employee->name,
                $employee->address,
                $employee->email,
                $employee->phone,
                $employee->position->name,
                $employee->active == 'S' ? 'Sí' : 'No'
            ];
        }
        $fileName = 'reporte_empleados_'. date('dmY_His').'.xlsx';
        return Excel::download(
            new class($headers, $data) implements FromCollection {
            private $headers;
            private $data;

            public function __construct($headers, $data)
            {
                $this->headers = $headers;
                $this->data = $data;
            }

            public function collection()
            {
                return collect([$this->headers])->merge($this->data);
            }
        }, $fileName);
    }

    public function docID($id)
    {
        $employee = Employees::find($id);

        $phpWord = new PhpWord();
        $section = $phpWord->addSection();

        # Title
        $section->addText(
            'Reporte de Empleado', 
            [
                'name' => 'Arial',
                'size' => 16,
                'bold' => true,
            ]
        );

        # Generate date
        $section->addText(
            'Fecha de Generación: ' . now()->format('d/m/Y H:i:s'), 
            [
                'name' => 'Arial',
                'size' => 12,
                'bold' => true,
            ]
        );

        $section->addTextBreak(2);

        # Table
        $table = $section->addTable([
            'borderSize' => 6,
            'borderColor' => '999999',
            'cellMargin' => 80,
        ]);

        # Header
        $table->addRow();
        $table->addCell(1000)->addText('ID', ['bold' => true]);
        $table->addCell(1000)->addText('Nombre', ['bold' => true]);
        $table->addCell(1000)->addText('Dirección', ['bold' => true]);
        $table->addCell(1000)->addText('Email', ['bold' => true]);
        $table->addCell(1000)->addText('Teléfono', ['bold' => true]);
        $table->addCell(1000)->addText('Puesto', ['bold' => true]);
        $table->addCell(1000)->addText('Activo', ['bold' => true]);

        # Data
        $table->addRow();
        $table->addCell(1000)->addText($employee->id);
        $table->addCell(1000)->addText($employee->name);
        $table->addCell(1000)->addText($employee->address);
        $table->addCell(1000)->addText($employee->email);
        $table->addCell(1000)->addText($employee->phone);
        $table->addCell(1000)->addText($employee->position->name);
        $table->addCell(1000)->addText($employee->active == 'S' ? 'Sí' : 'No');
        # Save file

        $fileName = 'reporte_empleado_'. $employee->name.'_' . date('d/m/Y_H:i:s').'.docx';
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');

        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
        exit;
    }

    public function xlsxID($id)
    {
        $employee = Employees::find($id);
        $headers = [
            'ID',
            'Nombre',
            'Dirección',
            'Email',
            'Teléfono',
            'Puesto',
            'Activo'
        ];
        $data = [
            $employee->id,
            $employee->name,
            $employee->address,
            $employee->email,
            $employee->phone,
            $employee->position->name,
            $employee->active == 'S' ? 'Sí' : 'No'
        ];
        $fileName = 'reporte_empleado_'. $employee->name.'_' . date('dmY_His').'.xlsx';
        return Excel::download(
            new class($headers, $data) implements FromCollection {
                private $headers;
                private $data;

                public function __construct($headers, $data)
                {
                    $this->headers = $headers;
                    $this->data = $data;
                }

                public function collection()
                {
                    return collect([$this->headers])->merge([$this->data]);
                }
            }, 
            $fileName
        );
    }
    
}
