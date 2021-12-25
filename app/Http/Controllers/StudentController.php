<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\StudentMarks;
use App\Models\ExamSchedule;

class StudentController extends Controller
{
    public function createStudent(Request $request)
    {
        $model = new Students();
        $model->id = $request->id;
        $model->full_name = $request->full_name;
        $model->class = $request->class;
        $model->phone_number = $request->phone_number;
        $model->email = $request->email;

        return response()->json($model->save());
    }

    public function deleteStudent(Request $request, $id)
    {
        Students::where('id', $id)->delete();
        StudentMarks::where('student_id', $id)->delete();
        ExamSchedule::where('student_id', $id)->delete();
        return response()->json("success");
    }

    public function updateStudent(Request $request)
    {
        $params = [
            'id' => $request->id,
            'full_name' => $request->full_name,
            'class' => $request->class,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
        ];

        Students::where('id', $params['id'])->update($params);
    }

    public function getStudent(Request $request)
    {
        return Students::when(!empty($request->email), function($query) use ($request) {
            return $query->where('email','LIKE','%'.$request->email.'%');
        })->when(!empty($request->full_name), function($query) use ($request) {
            return $query->where('full_name','LIKE','%'.$request->full_name.'%');
        })->when(!empty($request->id), function($query) use ($request) {
            return $query->where('id','LIKE','%'.$request->id.'%');
        })->when(!empty($request->phone_number), function($query) use ($request) {
            return $query->where('phone_number','LIKE','%'.$request->phone_number.'%');
        })->when(!empty($request->class), function($query) use ($request) {
            return $query->where('class','LIKE','%'.$request->class.'%');
        })->select('id', 'full_name', 'class', 'phone_number', 'email')->get();
    }

    public function createStudentMarks(Request $request)
    {
        $model = new StudentMarks();
        $model->student_id = $request->student_id;
        $model->subject = $request->subject;
        $model->marks = $request->marks;
        $model->semester = $request->semester;

        return response()->json($model->save());
    }

    public function deleteStudentMarks(Request $request, $id)
    {
        StudentMarks::where('id', $id)->delete();

        return response()->json("success");
    }

    public function updateStudentMarks(Request $request)
    {
        $params = [
            'student_id' => $request->student_id,
            'subject' => $request->subject,
            'marks' => $request->marks,
            'semester' => $request->semester,
        ];

        StudentMarks::where('id', $request->id)->update($params);
    }

    public function getStudentMarks(Request $request)
    {
        return StudentMarks::when(!empty($request->student_id), function($query) use ($request) {
            return $query->where('student_id','LIKE','%'.$request->student_id.'%');
        })->when(!empty($request->subject), function($query) use ($request) {
            return $query->where('subject','LIKE','%'.$request->subject.'%');
        })->when(!empty($request->marks), function($query) use ($request) {
            return $query->where('marks','LIKE','%'.$request->marks.'%');
        })->when(!empty($request->semester), function($query) use ($request) {
            return $query->where('semester','LIKE','%'.$request->semester.'%');
        })->select('id', 'student_id', 'subject', 'marks', 'semester')->get();
    }

    public function createExamSchedule(Request $request)
    {
        $model = new ExamSchedule();
        $model->class = $request->class;
        $model->student_id = $request->student_id;
        $model->subject = $request->subject;
        $model->date = $request->date;

        return response()->json($model->save());
    }

    public function deleteExamSchedule(Request $request, $id)
    {
        ExamSchedule::where('id', $id)->delete();

        return response()->json("success");
    }

    public function updateExamSchedule(Request $request)
    {
        $params = [
            'class' => $request->class,
            'subject' => $request->subject,
            'student_id' => $request->student_id,
            'date' => $request->date,
        ];

        ExamSchedule::where('id', $request->id)->update($params);
    }

    public function getExamSchedule(Request $request)
    {
        return ExamSchedule::when(!empty($request->class), function($query) use ($request) {
            return $query->where('class','LIKE','%'.$request->class.'%');
        })->when(!empty($request->student_id), function($query) use ($request) {
            return $query->where('student_id','LIKE','%'.$request->student_id.'%');
        })->when(!empty($request->subject), function($query) use ($request) {
            return $query->where('subject','LIKE','%'.$request->subject.'%');
        })->leftJoin('students', 'students.id', 'exam_schedule.student_id')->select('exam_schedule.id', 'exam_schedule.class', 'students.full_name as name', 'subject', 'date')->get();
    }

    public function deleteExamSchedules(Request $request)
    {
        ExamSchedule::whereIn('id', $request->ids)
            ->delete();

        return response()->json("success");
    }
}
