<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RoleSurvey;

class RoleSurveyController extends Controller{
	//khoi tao
	public function __construct(){
		parent::__construct();
	}

	public function index(request $request){
		$config = [
			'model' => new RoleSurvey(),
			'request' => $request
		];
		$this->config($config);
		$data = $this->model->web_index($this->request);

		return view('pages.admins.rolesurvey.index',['data' => $data]);
	}

	public function create_render(request $request){
		return view('pages.admins.rolesurvey.create');
	}

	public function create_submit(request $request){
		$config = [
			'model' => new RoleSurvey(),
			'request' => $request
		];
		$this->config($config);
		$data = $this->model->web_insert($this->request);
		return redirect('rolesurveys')->with('success','Added Successfully!');
	}

	public function edit($role_survey_id){
		$rolesurvey = RoleSurvey::findOrFail($role_survey_id);
		return view('pages.admins.rolesurvey.edit',compact('rolesurvey','role_survey_id'));
	}

	public function update(request $request, $role_survey_id){
		$rolesurvey = RoleSurvey::findOrFail($role_survey_id);

		$rolesurvey->role_id	=	$request->get('role_id');
		$rolesurvey->academy_id =	$request->get('academy_id');
		$rolesurvey->class_id	=	$request->get('class_id');
		$rolesurvey->survey_id	=	$request->get('survey_id');

		$rolesurvey->save();

		return redirect('rolesurveys')->with('success','Updated Successfully!');
	}

	public function destroy($role_survey_id){
		$data = RoleSurvey::findOrFail($role_survey_id);
		$data->delete();

		return redirect('rolesurveys')->with('success','Deleted Successfully!');
	}
}













