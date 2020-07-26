<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Folder;
use App\Files;
use Redirect;
use Illuminate\Support\Facades\Storage;
class FileManagerController extends Controller
{
    public function directory(Request $request){
        $dir = $request->input('name_of_folder');
        request()->validate([
            'name_of_folder'=>'required|unique:table_folder'
        ],[
            'name_of_folder.required'=>'Directory Name is Required'
        ]);

        $data = new Folder();
        $data->name_of_folder =$dir;
        if($data->save()==true){
            return Redirect::back()->with('success','Successfully created new folder');
        }else{
            return Redirect::back()->with('error','something got error');

        }
    }


    public function getDir(Request $request){
        $dir=Folder::all();
        return view('fileManager', ['dir'=>$dir]);
        
    }
    public function rename(Request $request){
        $dir = $request->input('folder');
        $id = $request->input('id');
        request()->validate([
            'folder'=>'required'
        ],[
            'folder.required'=>'Directory Name is Required'
        ]);

        $data = Folder::findOrFail($id);
        $data->name_of_folder =$dir;
        if($data->save()==true){
            return Redirect::back()->with('success','Successfully rename the folder');
        }else{
            return Redirect::back()->with('error','something got error');

        }
        return Redirect::back()->with('error','something got error');

    }

    public function deleteFolder(Request $request,$folder){
        $allFile= Files::where('folder_id',$folder)->get();
        $data=Folder::where('name_of_folder',$folder)->delete();
        if($data==true){
            foreach($allFile as $row){
                unlink(storage_path('app/public/images/'.$row->files));
            }
            $files=Files::where('folder_id',$folder)->delete();
            if($files==true){
                return Redirect::back()->with('success','Successfully deleted folder');
            }
        }
    }

    public function goToFolder(Request $request, $folder){
       $files = Files::where('folder_id',$folder)->get();
       return view('files',['files'=>$files, 'folder'=>$folder]);   
    }

    public function upload(Request $request,$folder){
        $file = $request->file('files');
        $size = $request->file('files')->getSize();
        $file_size = number_format($size / 1048576,2);
        $formatSize=$file_size.'MB';
        request()->validate([
            'files'=>'required|unique:table_files'
        ],[ ]);
        $originalName=$file->getClientOriginalName();
        $originalFileName=explode('.', $originalName)[0];
        $input['imagename'] = $originalFileName.'.'.$file->getClientOriginalExtension();
        $name=$input['imagename'];
        $dir = 'public/';
        $path = 'images/';
        Storage::disk('local')->putFileAs($dir.$path, ($file),$name);
        $data = new Files();
        $data->folder_id=$folder;
        $data->files=$name;
        $data->file_name=$name;
        $data->size=$formatSize;
        if($data->save()==true){
            return Redirect::back()->with('success','Successfully upload the file');
        }else{
            return Redirect::back()->with('error','something got error');

        }

    }

    public function deleteFile(Request $request,$id){
        $file = Files::where('id',$id)->first();
        $data= Files::where('id',$id)->delete();
        if($data==true){
            unlink(storage_path('app/public/images/'.$file->files));
            return Redirect::back()->with('success','Successfully deleted file');
        }else{
            return Redirect::back()->with('error','Something get error');

        }
    }

    public function renameFile(Request $request){
        $id=$request->input('id');
        $file= $request->input('folder');
        $newfile=$request->input('newfolder');
        $data= Files::findOrFail($id);
        $data->files=$newfile;
        $data->file_name=$newfile;
        if($data->save()==true){
            Storage::rename('public/images/'.$file, 'public/images/'.$newfile);
            return Redirect::back()->with('success','Successfully rename the file');
        }else{
            return Redirect::back()->with('error','something got error');

        }
    }

    public function downloadFile(Request $request,$id){
        return response()->download(storage_path('app/public/images/'.$id));
        
    }

}
