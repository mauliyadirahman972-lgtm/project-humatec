<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Project;
use App\Models\Label;
use App\Models\Task;
use App\Models\TaskAssignment;
use Illuminate\Http\Request;

class ProjectManagementController extends Controller
{

    public function getEmployees(Request $request) { 
        $query = Employee::query();
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('role', 'like', "%{$search}%");
        }
        $employees = $query->paginate(10)->withQueryString();
        return view('employees.index', compact('employees')); 
    }

    public function createEmployee() {
        return view('employees.create');
    }

    public function storeEmployee(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'role' => 'nullable|string'
        ]);
        Employee::create($validated);
        return redirect()->route('employees.index')->with('success', 'Employee created successfully');
    }

    public function editEmployee(Employee $employee) {
        return view('employees.edit', compact('employee'));
    }

    public function updateEmployee(Request $request, Employee $employee) {
        $employee->update($request->all());
        return redirect()->route('employees.index')->with('success', 'Employee updated successfully');
    }

    public function deleteEmployee(Employee $employee) {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully');
    }


    public function getProjects(Request $request) { 
        $query = Project::with('tasks');
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('status', 'like', "%{$search}%");
        }
        $projects = $query->paginate(10)->withQueryString();
        return view('projects.index', compact('projects')); 
    }

    public function createProject() {
        return view('projects.create');
    }

    public function storeProject(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:Planning,In Progress,Completed'
        ]);
        Project::create($request->all());
        return redirect()->route('projects.index')->with('success', 'Project created successfully');
    }

    public function editProject(Project $project) {
        return view('projects.edit', compact('project'));
    }

    public function updateProject(Request $request, Project $project) {
        $project->update($request->all());
        return redirect()->route('projects.index')->with('success', 'Project updated successfully');
    }

    public function deleteProject(Project $project) {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully');
    }


    public function getLabels(Request $request) { 
        $query = Label::query();
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }
        $labels = $query->paginate(10)->withQueryString();
        return view('labels.index', compact('labels')); 
    }

    public function createLabel() {
        return view('labels.create');
    }

    public function storeLabel(Request $request) {
        $request->validate(['name' => 'required|unique:labels,name', 'color' => 'nullable|string|size:7']);
        Label::create($request->all());
        return redirect()->route('labels.index')->with('success', 'Label created successfully');
    }

    public function editLabel(Label $label) {
        return view('labels.edit', compact('label'));
    }

    public function updateLabel(Request $request, Label $label) {
        $label->update($request->all());
        return redirect()->route('labels.index')->with('success', 'Label updated successfully');
    }

    public function deleteLabel(Label $label) {
        $label->delete();
        return redirect()->route('labels.index')->with('success', 'Label deleted successfully');
    }

    
    public function getTasks(Request $request) {
        $query = Task::with(['project', 'label', 'employees']);
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('status', 'like', "%{$search}%")
                  ->orWhereHas('project', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
        }
        $tasks = $query->paginate(10)->withQueryString();
        return view('tasks.index', compact('tasks'));
    }

    public function createTask() {
        $projects = Project::all();
        $labels = Label::all();
        return view('tasks.create', compact('projects', 'labels'));
    }

    public function storeTask(Request $request) {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'label_id' => 'nullable|exists:labels,id',
            'title' => 'required|string',
            'status' => 'required|in:To Do,In Progress,Review,Done',
            'due_date' => 'nullable|date'
        ]);
        Task::create($request->all());
        return redirect()->route('tasks.index')->with('success', 'Task created successfully');
    }

    public function editTask(Task $task) {
        $projects = Project::all();
        $labels = Label::all();
        return view('tasks.edit', compact('task', 'projects', 'labels'));
    }

    public function updateTask(Request $request, Task $task) {
        $task->update($request->all());
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully');
    }

    public function deleteTask(Task $task) {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully');
    }

    public function assignEmployee(Request $request, Task $task) {
        $request->validate(['employee_ids' => 'required|array', 'employee_ids.*' => 'exists:employees,id']);
        $task->employees()->sync($request->employee_ids); 
        return redirect()->route('tasks.index')->with('success', 'Task assignments updated successfully');
    }

    public function removeAssignments(Task $task) {
        $task->employees()->detach();
        return redirect()->route('tasks.index')->with('success', 'All assignments removed for this task');
    }

    // Task Assignments CRUD
    public function getTaskAssignments(Request $request) {
        $query = TaskAssignment::with(['task', 'employee']);
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('task', function($q) use ($search) {
                      $q->where('title', 'like', "%{$search}%");
                  })
                  ->orWhereHas('employee', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
        }
        $taskAssignments = $query->paginate(10)->withQueryString();
        return view('task_assignments.index', compact('taskAssignments'));
    }

    public function createTaskAssignment() {
        $tasks = Task::all();
        $employees = Employee::all();
        return view('task_assignments.create', compact('tasks', 'employees'));
    }

    public function storeTaskAssignment(Request $request) {
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'employee_id' => 'required|exists:employees,id',
        ]);
        
        // Prevent duplicate assignments
        if (TaskAssignment::where('task_id', $request->task_id)->where('employee_id', $request->employee_id)->exists()) {
            return back()->withErrors(['employee_id' => 'This employee is already assigned to this task.']);
        }

        TaskAssignment::create($request->all());
        return redirect()->route('task_assignments.index')->with('success', 'Task Assignment created successfully');
    }

    public function editTaskAssignment(TaskAssignment $taskAssignment) {
        $tasks = Task::all();
        $employees = Employee::all();
        return view('task_assignments.edit', compact('taskAssignment', 'tasks', 'employees'));
    }

    public function updateTaskAssignment(Request $request, TaskAssignment $taskAssignment) {
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'employee_id' => 'required|exists:employees,id',
        ]);

        if (TaskAssignment::where('task_id', $request->task_id)->where('employee_id', $request->employee_id)->where('id', '!=', $taskAssignment->id)->exists()) {
            return back()->withErrors(['employee_id' => 'This employee is already assigned to this task.']);
        }

        $taskAssignment->update($request->all());
        return redirect()->route('task_assignments.index')->with('success', 'Task Assignment updated successfully');
    }

    public function deleteTaskAssignment(TaskAssignment $taskAssignment) {
        $taskAssignment->delete();
        return redirect()->route('task_assignments.index')->with('success', 'Task Assignment deleted successfully');
    }
}