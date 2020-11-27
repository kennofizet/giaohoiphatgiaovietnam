<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Model\Official;
use App\Model\OfficialCategorys;
use App\Model\OfficialPosition;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class OfficialController extends Controller
{
    public function create(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator ->fails()) {

            if($request->ajax())
            {
                return response()->json(array(
                    'success' => false,
                    'message' => 'validator',
                    'errors' => $validator->getMessageBag()->toArray()
                ), 200);
            }

            $this->throwValidationException(

                $request, $validator

            );

        }else{
            if ($request->hasFile('photo_profile')) {
                $file = $request->photo_profile;
                $file_extension = $file->getClientOriginalExtension(); 
                if($file_extension == 'png' or $file_extension == 'jpg' or $file_extension == 'jpeg' or $file_extension == 'PNG' or $file_extension == 'JPG' or $file_extension == 'JPEG'){
                    $file_name_old = $file->getClientOriginalName();
                    $file_name = Str::of($file_name_old)->replace(' ', '_')->replace("'", '_')->replace('.', '_')->replace('(', '')->replace(')', '');
                    $random_file_name_photo_profile = time().Str::random(20).'_'.$file_name;
                    while(file_exists('uploads/source/api/blog/images/'.$random_file_name_photo_profile))
                    {
                        $random_file_name_photo_profile = time().Str::random(20).'_'.$file_name;
                    }
                    $crop_file = Image::make($file);
                    if(!Storage::disk('public_upload')->put('source/api/blog/images/'.$random_file_name_photo_profile.".jpg", $crop_file->encode('jpg')->__toString())) {
                        return false;
                    }
                }else{
                    $random_file_name_photo_profile = '';
                };

            }else{
                    $random_file_name_photo_profile = '';
            };
            if ($request->hasFile('qr_code')) {
                $file = $request->qr_code;
                $file_extension = $file->getClientOriginalExtension(); 
                if($file_extension == 'png' or $file_extension == 'jpg' or $file_extension == 'jpeg' or $file_extension == 'PNG' or $file_extension == 'JPG' or $file_extension == 'JPEG'){
                    $file_name_old = $file->getClientOriginalName();
                    $file_name = Str::of($file_name_old)->replace(' ', '_')->replace("'", '_')->replace('.', '_')->replace('(', '')->replace(')', '');
                    $random_file_name_qr_code = time().Str::random(20).'_'.$file_name;
                    while(file_exists('uploads/source/api/blog/images/'.$random_file_name_qr_code))
                    {
                        $random_file_name_qr_code = time().Str::random(20).'_'.$file_name;
                    }
                    $crop_file = Image::make($file);
                    if(!Storage::disk('public_upload')->put('source/api/blog/images/'.$random_file_name_qr_code.".jpg", $crop_file->encode('jpg')->__toString())) {
                        return false;
                    }
                }else{
                    $random_file_name_qr_code = '';
                };

            }else{
                $random_file_name_qr_code = '';
            };
            $name = $request->name;
            $card_number = $request->card_number;
            $photo_profile = $random_file_name_photo_profile;
            $alias = $request->alias;
            $category = $request->category;
            $date_of_birth = $request->date_of_birth;
            $cmnd = $request->cmnd;
            $position = $request->position;
            $address = $request->address;
            $qr_code = $random_file_name_qr_code;

            $new_official = new Official;
            $new_official->name = $name;
            $new_official->card_number = $card_number;
            $new_official->photo_profile = $photo_profile;
            $new_official->alias = $alias;
            $new_official->category = $category;
            $new_official->date_of_birth = $date_of_birth;
            $new_official->cmnd = $cmnd;
            $new_official->position = $position;
            $new_official->address = $address;
            $new_official->qr_code = $qr_code;
            $new_official->save();

            return ['message' => "success"];
        }
    }
    public function edit(Request $request)
    {
        // dd($request);
        $validator  = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator ->fails()) {

            if($request->ajax())
            {
                return response()->json(array(
                    'success' => false,
                    'message' => 'validator',
                    'errors' => $validator->getMessageBag()->toArray()
                ), 200);
            }

            $this->throwValidationException(

                $request, $validator

            );

        }else{
            $id = $request->id;
            // dd($id);
            try {
                $old_official = Official::findOrFail($id);
            } catch (ModelNotFoundException $ex) {
                return abort(404);
            };
            if ($request->hasFile('photo_profile')) {
                $file = $request->photo_profile;
                $file_extension = $file->getClientOriginalExtension(); 
                if($file_extension == 'png' or $file_extension == 'jpg' or $file_extension == 'jpeg' or $file_extension == 'PNG' or $file_extension == 'JPG' or $file_extension == 'JPEG'){
                    $file_name_old = $file->getClientOriginalName();
                    $file_name = Str::of($file_name_old)->replace(' ', '_')->replace("'", '_')->replace('.', '_')->replace('(', '')->replace(')', '');
                    $random_file_name_photo_profile = time().Str::random(20).'_'.$file_name;
                    while(file_exists('uploads/source/api/blog/images/'.$random_file_name_photo_profile))
                    {
                        $random_file_name_photo_profile = time().Str::random(20).'_'.$file_name;
                    }
                    $crop_file = Image::make($file);
                    if(!Storage::disk('public_upload')->put('source/api/blog/images/'.$random_file_name_photo_profile.".jpg", $crop_file->encode('jpg')->__toString())) {
                        return false;
                    }
                }else{
                    $random_file_name_photo_profile = $old_official->photo_profile;
                };

            }else{
                    $random_file_name_photo_profile = $old_official->photo_profile;
            };
            if ($request->hasFile('qr_code')) {
                $file = $request->qr_code;
                $file_extension = $file->getClientOriginalExtension(); 
                if($file_extension == 'png' or $file_extension == 'jpg' or $file_extension == 'jpeg' or $file_extension == 'PNG' or $file_extension == 'JPG' or $file_extension == 'JPEG'){
                    $file_name_old = $file->getClientOriginalName();
                    $file_name = Str::of($file_name_old)->replace(' ', '_')->replace("'", '_')->replace('.', '_')->replace('(', '')->replace(')', '');
                    $random_file_name_qr_code = time().Str::random(20).'_'.$file_name;
                    while(file_exists('uploads/source/api/blog/images/'.$random_file_name_qr_code))
                    {
                        $random_file_name_qr_code = time().Str::random(20).'_'.$file_name;
                    }
                    $crop_file = Image::make($file);
                    if(!Storage::disk('public_upload')->put('source/api/blog/images/'.$random_file_name_qr_code.".jpg", $crop_file->encode('jpg')->__toString())) {
                        return false;
                    }
                }else{
                    $random_file_name_qr_code = $old_official->qr_code;
                };

            }else{
                $random_file_name_qr_code = $old_official->qr_code;
            };
            $name = $request->name;
            $card_number = $request->card_number;
            $photo_profile = $random_file_name_photo_profile;
            $alias = $request->alias;
            $category = $request->category;
            $date_of_birth = $request->date_of_birth;
            $cmnd = $request->cmnd;
            $position = $request->position;
            $address = $request->address;
            $qr_code = $random_file_name_qr_code;

            $new_official = Official::find($id);
            $new_official->name = $name;
            $new_official->card_number = $card_number;
            $new_official->photo_profile = $photo_profile;
            $new_official->alias = $alias;
            $new_official->category = $category;
            $new_official->date_of_birth = $date_of_birth;
            $new_official->cmnd = $cmnd;
            $new_official->position = $position;
            $new_official->address = $address;
            $new_official->qr_code = $qr_code;
            $new_official->update();

            return ['message' => "success"];
        }
    }
    public function delete(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($validator ->fails()) {

            if($request->ajax())
            {
                return response()->json(array(
                    'success' => false,
                    'message' => 'validator',
                    'errors' => $validator->getMessageBag()->toArray()
                ), 200);
            }

            $this->throwValidationException(

                $request, $validator

            );

        }else{
            $id = $request->id;
            try {
                $delete_official = Official::findOrFail($id);
            } catch (ModelNotFoundException $ex) {
                return abort(404);
            };
            $delete_official->delete();

            return ['message' => "success"];
        }
    }
    public function createCategory(Request $request)
    {
    	$validator  = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator ->fails()) {

            if($request->ajax())
            {
                return response()->json(array(
                    'success' => false,
                    'message' => 'validator',
                    'errors' => $validator->getMessageBag()->toArray()
                ), 200);
            }

            $this->throwValidationException(

                $request, $validator

            );

        }else{
	        $name = $request->name;
	        $description = $request->description;
	        $content = $request->content;

	        $new_category = new OfficialCategorys;
	        $new_category->name = $name;
	        $new_category->description = $description;
	        $new_category->content = $content;
	        $new_category->save();

	        return ['message' => "success"];
	    }
    }
     public function editCategory(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required',
        ]);
        if ($validator ->fails()) {

            if($request->ajax())
            {
                return response()->json(array(
                    'success' => false,
                    'message' => 'validator',
                    'errors' => $validator->getMessageBag()->toArray()
                ), 200);
            }

            $this->throwValidationException(

                $request, $validator

            );

        }else{
            $id = $request->id;
            $name = $request->name;
            $description = $request->description;
            $content = $request->content;

            try {
                $update_category = OfficialCategorys::findOrFail($id);
            } catch (ModelNotFoundException $ex) {
                return abort(404);
            };

            $update_category->name = $name;
            $update_category->description = $description;
            $update_category->content = $content;
            $update_category->update();

            return ['message' => "success"];
        }
    }
    public function deleteCategory(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($validator ->fails()) {

            if($request->ajax())
            {
                return response()->json(array(
                    'success' => false,
                    'message' => 'validator',
                    'errors' => $validator->getMessageBag()->toArray()
                ), 200);
            }

            $this->throwValidationException(

                $request, $validator

            );

        }else{
            $id = $request->id;
            try {
                $delete_category = OfficialCategorys::findOrFail($id);
            } catch (ModelNotFoundException $ex) {
                return abort(404);
            };
            $delete_category->delete();

            return ['message' => "success"];
        }
    }
    public function createPosition(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator ->fails()) {

            if($request->ajax())
            {
                return response()->json(array(
                    'success' => false,
                    'message' => 'validator',
                    'errors' => $validator->getMessageBag()->toArray()
                ), 200);
            }

            $this->throwValidationException(

                $request, $validator

            );

        }else{
            $name = $request->name;
            $description = $request->description;
            $content = $request->content;

            $new_position = new OfficialPosition;
            $new_position->name = $name;
            $new_position->description = $description;
            $new_position->content = $content;
            $new_position->save();

            return ['message' => "success"];
        }
    }
     public function editPosition(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required',
        ]);
        if ($validator ->fails()) {

            if($request->ajax())
            {
                return response()->json(array(
                    'success' => false,
                    'message' => 'validator',
                    'errors' => $validator->getMessageBag()->toArray()
                ), 200);
            }

            $this->throwValidationException(

                $request, $validator

            );

        }else{
            $id = $request->id;
            $name = $request->name;
            $description = $request->description;
            $content = $request->content;

            try {
                $update_position = OfficialPosition::findOrFail($id);
            } catch (ModelNotFoundException $ex) {
                return abort(404);
            };

            $update_position->name = $name;
            $update_position->description = $description;
            $update_position->content = $content;
            $update_position->update();

            return ['message' => "success"];
        }
    }
    public function deletePosition(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($validator ->fails()) {

            if($request->ajax())
            {
                return response()->json(array(
                    'success' => false,
                    'message' => 'validator',
                    'errors' => $validator->getMessageBag()->toArray()
                ), 200);
            }

            $this->throwValidationException(

                $request, $validator

            );

        }else{
            $id = $request->id;
            try {
                $delete_position = OfficialPosition::findOrFail($id);
            } catch (ModelNotFoundException $ex) {
                return abort(404);
            };
            $delete_position->delete();

            return ['message' => "success"];
        }
    }
}
