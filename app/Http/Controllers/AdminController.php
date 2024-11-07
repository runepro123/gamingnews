<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function adminList() {
        $data['headerTitle'] = 'Admin List';
        $data['admins'] = Admin::latest()->get();

        return view('backend.admin.admin.index', $data);
    }

    public function add() {
        $data['headerTitle'] = 'Add New Admin';

        return view('backend.admin.admin.add', $data);
    }

    public function insert(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'email' => ['required', 'email', 'max:255', Rule::unique(Admin::class, 'email')],
            'password' => 'required|string|min:8|confirmed'
        ]);

        $admin = new Admin;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = bcrypt($request->password);
        $admin->save();

        return redirect('admin/list')->with("success", "Admin successfully added.");
    }

    public function edit($id) {
        $data['admin'] = Admin::find($id);

        if(!empty($data['admin'])) {
            $data['headerTitle'] = 'Edit Admin';

            return view('backend.admin.admin.edit', $data);
        }else {
            abort(404);
        }
    }

    public function update(Request $request) {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $admin = Admin::find($request->admin_id);

        $admin->name = $request->name;
        $admin->status = $request->status;
        $admin->save();

        return redirect('admin/list')->with("success", "Admin successfully updated.");
    }

    public function delete($id)
    {
        $admin = Admin::find($id);

        if (empty($admin)) {
            abort(404);  
        }

        if(\Auth::guard('admin')->user()->role == 'admin') {
            try {
                $admin->delete();
                return redirect('admin/list')->with("success", "Admin successfully deleted.");
            } catch (\Exception $e) {
                return redirect('admin/list')->with("error", "Error deleting Admin: " . $e->getMessage());
            }

        }else {
            return redirect()->back()->with("error", "You do not have permission to delete admins.");

        }

     
    }

}
