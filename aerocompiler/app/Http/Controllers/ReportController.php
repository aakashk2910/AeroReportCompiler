<?php

namespace App\Http\Controllers;

use App\AdminIndex;
use App\FormInput;
use App\Http\Controllers\Admin\scoreController;
use App\Pic;
use App\Report;
use App\Role_users;
use App\score;
use App\scoreTable;
use App\SelectGroupAdmin;
use App\OrganizationalEnv;
use App\Time;
use Illuminate\Http\Request;
use App\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class ReportController extends Controller
{
    /**
     * @param $param
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */



    public function index($uid, $sid, $reportId){
        $data = DB::table('criterias')->get();
        $data1 = DB::table('subCriterias')->get();
        /** @var TYPE_NAME $sid */
        $sid = $sid;
        $uid = $uid;
        $sname = DB::table('subCriterias')->where('id', $sid)->value('subCriteriaName');
        $cid = DB::table('subCriterias')->where('id', $sid)->value('criteriaId');
        $cname = DB::table('criterias')->where('criteriaId', $cid)->value('criteriaName');
        $flabel = DB::table('formlabels')->get();

        return view('Report.reportInput',compact('data','data1','sname', 'cname', 'sid', 'flabel', 'uid', 'reportId'));
    }

    public function adminIndex($uid = null, $sid = null){
        $data = DB::table('criterias')->get();
        $data1 = DB::table('subCriterias')->get();
        /** @var TYPE_NAME $sid */
        $sid = $sid;
        $uid = $uid;
        $sname = DB::table('subCriterias')->where('subCriteriaId', $sid)->value('subCriteriaName');
        $cid = DB::table('subCriterias')->where('subCriteriaId', $sid)->value('criteriaId');
        $cname = DB::table('criterias')->where('criteriaId', $cid)->value('criteriaName');
        $flabel = DB::table('formlabels')->get();
        $rid = DB::table('adminindices')->where('userId', $uid)->value('reportId');

        return view('Report.groupAdminReportInput',compact('data','data1','sname', 'cname', 'sid', 'flabel', 'uid', 'rid'));
    }

    public function select(){
        $data = DB::table('criterias')->get();
        $data1 = DB::table('subCriterias')->get();
        $user = DB::table('users')->get();

        return view('admin.gAdminSelect',compact('data','data1','user'));
    }
//'userId', 'subCriteriaId', 'labelId', 'labelText', 'A', 'D', 'L', 'I'

    public function savedata($uid = null, $sid = null, $labelId = null, $reportId = null){
        $FormInput = new FormInput();
        $FormInput->userId = $uid;
        $FormInput->subCriteriaId = $sid;
        $FormInput->labelId = $labelId;
        $FormInput->labelText = Input::get(DB::table('formlabels')->where('id', $labelId)->value('labelText'));
        if(Input::get('A')) $FormInput->A = 1;
        if(Input::get('D')) $FormInput->D = 1;
        if(Input::get('L')) $FormInput->L = 1;
        if(Input::get('I')) $FormInput->I = 1;
        $FormInput->reportId = $reportId;
        $FormInput->save();

        return Redirect::to('/report/'.$uid.'/'.$sid.'/'.$reportId);
    }

    public function updatedata($uid = null, $sid = null, $labelId = null, $id , $reportId ){
        $FormInput = FormInput::findOrNew($id);
        $FormInput->userId = $uid;
        $FormInput->subCriteriaId = $sid;
        $FormInput->labelId = $labelId;
        $FormInput->labelText = Input::get(DB::table('formlabels')->where('id', $labelId)->value('labelText'));
        if(Input::get('A')) $FormInput->A = 1;
        if(Input::get('D')) $FormInput->D = 1;
        if(Input::get('L')) $FormInput->L = 1;
        if(Input::get('I')) $FormInput->I = 1;
        $FormInput->reportId = $reportId;
        $FormInput->save();

        return Redirect::to('/report/'.$uid.'/'.$sid.'/'.$reportId);
    }

    public function add($uid = null, $sid = null, $labelId, $reportId){
        $FormInput = new FormInput();
        $FormInput->userId = $uid;
        $FormInput->subCriteriaId = $sid;
        $FormInput->labelId = $labelId;
        $FormInput->labelText = '';
        if(Input::get('A')) $FormInput->A = 1;
        if(Input::get('D')) $FormInput->D = 1;
        if(Input::get('L')) $FormInput->L = 1;
        if(Input::get('I')) $FormInput->I = 1;
        $FormInput->reportId = $reportId;
        $FormInput->save();

        return Redirect::to('/report/'.$uid.'/'.$sid.'/'.$reportId);
    }

    public function delete($uid = null, $sid = null, $labelId = null, $id, $reportId){
        $FormInput = FormInput::findOrNew($id);
        $FormInput->delete();

        return Redirect::to('/report/'.$uid.'/'.$sid, $reportId);
    }

    public function assign(){
        $data = DB::table('criterias')->get();
        $data1 = DB::table('subCriterias')->get();
        $report = DB::table('reports')->get();
        $user = DB::table('users')->get();

        return view('admin.reportAssign',compact('data','data1','report','user'));
    }


    public function assigned(){
        $input = Input::except('_token');

        foreach($input as $i=>$k){
            /** @var TYPE_NAME $i */
            if($k != '') {
                if (DB::table('adminindices')->where('userId', $i)->value('id')) {
                    $id = DB::table('adminindices')->where('userId', $i)->value('id');
                    $AdminIndex = AdminIndex::FindOrNew($id);
                } else {
                    $AdminIndex = new AdminIndex();
                }
                $AdminIndex->userId = $i;
                $AdminIndex->reportId = $k;
                $AdminIndex->save();
            }
        }
        return  Redirect::to('/reportassign');
    }

    public function scoreMapping(){
        $data = DB::table('criterias')->get();
        $data1 = DB::table('subCriterias')->get();
        $user = DB::table('users')->get();

        return view('admin.scoreIndex', compact('data','data1', 'user'));
    }

    public function mappedScore(){
        $data = DB::table('criterias')->get();
        $data1 = DB::table('subCriterias')->get();
        $user = DB::table('users')->get();
        $input = Input::except('_token');

        foreach($input as $i=>$k){
            $scoreTable = new scoreTable();
            $scoreTable->subcriteriaId = $i;
            $scoreTable->maxScore = $k;
            $scoreTable->save();
        }

        return view('admin.scoreIndex', compact('data','data1', 'user'));
    }

    public function updateMappedScore(){
        $data = DB::table('criterias')->get();
        $data1 = DB::table('subCriterias')->get();
        $user = DB::table('users')->get();
        $input = Input::except('_token');

        foreach($input as $i=>$k){
            $index = DB::table('scoretables')->where('subCriteriaId', $i)->value('id');
            $scoreTable = scoreTable::FindOrNew($index);
            $scoreTable->subcriteriaId = $i;
            $scoreTable->maxScore = $k;
            $scoreTable->save();
        }

        return view('admin.scoreIndex', compact('data','data1', 'user'));
    }

    /**
     * @param null $uid
     * @param null $sid
     * @return mixed
     */
    public function SetScore($uid = null, $sid = null, $reportId){
        $score = new score();
        $score->userId = $uid;
        $score->subCriteriaId = $sid;
        $score->reportId = $reportId;
        $score->score = Input::get('score');
        $score->save();

        return Redirect::to('/report/'.$uid.'/'.$sid.'/'.$reportId);
    }

    public function UpdateScore($uid = null, $sid = null, $reportId = null){
        $id = DB::table('scores')->where('userId', $uid)->where('subCriteriaId', $sid)->where('reportId', $reportId)->value('id');
        $score = score::FindOrFail($id);
        $score->score = Input::get('score');
        $score->save();

        return Redirect::to('/report/'.$uid.'/'.$sid.'/'.$reportId);
    }

    public function SelectGA(){
        $input = Input::except('_token');

        $SelectGroupAdmin = new SelectGroupAdmin();
        $SelectGroupAdmin->truncate();

        foreach($input as $i=>$k){
            $SelectGroupAdmin = new SelectGroupAdmin();
            $SelectGroupAdmin->userId = $i;
            $SelectGroupAdmin->save();
        }

        $su = DB::table('role_user')->where('role_id', 1 )->get();

        $Role_users = new Role_users();
        $Role_users->truncate();

        foreach($su as $s){
            $Role_users = new Role_users();
            $Role_users->role_id = 1;
            $Role_users->user_id = $s->user_id;
            $Role_users->save();
        }

        foreach($input as $i=>$k){

            $user = User::find($i);

            $user->attachRole(2);
        }

        return Redirect::to('/groupadmin');
    }

    public function kbf1($uid, $reportId){
        $data = DB::table('criterias')->get();
        $data1 = DB::table('subCriterias')->get();
        return view('KBF.kbf1',compact('data', 'data1','uid', 'reportId'));
    }

    public function kbf2($uid, $reportId){
        $data = DB::table('criterias')->get();
        $data1 = DB::table('subCriterias')->get();
        return view('KBF.kbf2',compact('data', 'data1','uid', 'reportId'));
    }

    //Route::get('/kbf1save/{uid}/{reportId}/{subId}{opId}','ReportController@kbf1save');
    //protected $fillable = ['userId', 'reportId', 'opId', 'opSubId', 'opInnerId', 'f1', 'f2', 'f3'];
    public function kbf1save($uid , $reportId, $subId, $opId)
    {
        $input = Input::except('_token', '_wysihtml5_mode');
        $init = current($input);
        $total = count($input)/4;

        //print_r($input); return;
        //echo $init; echo $total; return;

        for($i = $init; $i<=($total+$init-1); $i++){
            /** @var TYPE_NAME $i */
                if (DB::table('organizationalenvs')->where('userId', $uid)->where('reportId', $reportId)->where('opId', $opId)->where('opSubId',$subId)->where('opInnerId',$i)->value('id')) {
                    $id = DB::table('organizationalenvs')->where('userId', $uid)->where('reportId', $reportId)->where('opId', $opId)->where('opSubId',$subId)->where('opInnerId',$i)->value('id');
                    $OrganizationalEnv = OrganizationalEnv::FindOrNew($id);
                } else {
                    $OrganizationalEnv = new OrganizationalEnv();
                }

                $OrganizationalEnv->userId = $uid;
                $OrganizationalEnv->reportId = $reportId;
                $OrganizationalEnv->opId = $opId;
                $OrganizationalEnv->opSubId = $subId;
                $OrganizationalEnv->opInnerId = Input::get('opInner_'.$i);
                $OrganizationalEnv->f1 = Input::get('f1_'.$i);
                $OrganizationalEnv->f2 = Input::get('f2_'.$i);
                $OrganizationalEnv->f3 = Input::get('f3_'.$i);
                $OrganizationalEnv->save();
        }
        return  Redirect::to('/kbf1/'.$uid.'/'.$reportId);
    }

    public function kbf2save($uid , $reportId, $subId, $opId)
    {
        $input = Input::except('_token', '_wysihtml5_mode');
        $init = current($input);
        $total = count($input)/4;

        //print_r($input); return;
        //echo $init; echo $total; return;

        for($i = $init; $i<=($total+$init-1); $i++){
            /** @var TYPE_NAME $i */
            if (DB::table('organizationalenvs')->where('userId', $uid)->where('reportId', $reportId)->where('opId', $opId)->where('opSubId',$subId)->where('opInnerId',$i)->value('id')) {
                $id = DB::table('organizationalenvs')->where('userId', $uid)->where('reportId', $reportId)->where('opId', $opId)->where('opSubId',$subId)->where('opInnerId',$i)->value('id');
                $OrganizationalEnv = OrganizationalEnv::FindOrNew($id);
            } else {
                $OrganizationalEnv = new OrganizationalEnv();
            }

            $OrganizationalEnv->userId = $uid;
            $OrganizationalEnv->reportId = $reportId;
            $OrganizationalEnv->opId = $opId;
            $OrganizationalEnv->opSubId = $subId;
            $OrganizationalEnv->opInnerId = Input::get('opInner_'.$i);
            $OrganizationalEnv->f1 = Input::get('f1_'.$i);
            $OrganizationalEnv->f2 = Input::get('f2_'.$i);
            $OrganizationalEnv->f3 = Input::get('f3_'.$i);
            $OrganizationalEnv->save();
        }
        return  Redirect::to('/kbf2/'.$uid.'/'.$reportId);
    }


    public function createNew(){
        $data = DB::table('criterias')->get();
        $data1 = DB::table('subCriterias')->get();
        $user = DB::table('users')->get();

        return view('payment');
        //return Redirect::to('/payment/'.$user);
    }

    public function rform($uid){
        return view('Report.createReport');
    }
    public function saveNew($uid ){

        $Report = new Report();
        $Report->reportId = Input::get('rid');
        $Report->reportName = Input::get('rname');
        $Report->save();

        $AdminIndex = new AdminIndex();
        $AdminIndex->userId = $uid;
        $AdminIndex->reportId = DB::table('reports')->where('reportId', Input::get('rid'))->where('reportName', Input::get('rname'))->value('id');
        $AdminIndex->save();

        return Redirect::to('/');
    }

    public function OpenReport($reportId){
        $data = DB::table('criterias')->get();
        $data1 = DB::table('subCriterias')->get();
        $user = DB::table('users')->get();

        return view('reportHome', compact('data','data1', 'user', 'reportId'));

    }

    public function FinalReport($reportId){
        $data = DB::table('criterias')->get();
        $data1 = DB::table('subCriterias')->get();
        $user = DB::table('users')->get();
        $flabel = DB::table('formlabels')->get();

        return view('finalReport', compact('data','data1', 'user', 'reportId', 'flabel'));

    }

    public function DownloadReport($reportId){
        $data = DB::table('criterias')->get();
        $data1 = DB::table('subCriterias')->get();
        $user = DB::table('users')->get();
        $flabel = DB::table('formlabels')->get();

        return view('downloadReport', compact('data','data1', 'user', 'reportId', 'flabel'));

    }

    public function FinalScore($reportId){
        $data = DB::table('criterias')->get();
        $data1 = DB::table('subCriterias')->get();
        $user = DB::table('users')->get();
        $flabel = DB::table('formlabels')->get();

        return view('scoreMatrix', compact('data','data1', 'user', 'reportId', 'flabel'));

    }

    public function ADLI($reportId){
        $data = DB::table('criterias')->get();
        $data1 = DB::table('subCriterias')->get();
        $user = DB::table('users')->get();
        $flabel = DB::table('formlabels')->get();

        return view('adliMatrix', compact('data','data1', 'user', 'reportId', 'flabel'));

    }

    public function Profile(){

        return view('profile');
    }

    public function uploadPic() {

        $id = DB::table('pics')->where('userId', Auth::user()->id)->value('id');
        if (!$id) {
            $entry = new Pic();
            $extension = Input::file('image')->getClientOriginalExtension();
            Input::file('image')->move(
                base_path() . '/public/images/catalog/', Input::file('image')->getFilename() . '.' . $extension);
                    $entry->userId = Auth::user()->id;
                    $entry->mime = Input::file('image')->getClientMimeType();
                    $entry->original_filename = Input::file('image')->getClientOriginalName();
                    $entry->filename = Input::file('image')->getFilename() . '.' . $extension;
                    $entry->country = Input::get('country');
                    $entry->state = Input::get('state');
                    $entry->city = Input::get('city');
                    $entry->profession = Input::get('profession');

        } else {
            $entry = Pic::FindOrNew($id);
            $pics = DB::table('pics')->where('userId', Auth::user()->id)->value('mime');
            if(!$pics || $pics == "") {
                $ch = Input::file('image');
                if ($ch) {
                    $extension = Input::file('image')->getClientOriginalExtension();
                    Input::file('image')->move(
                        base_path() . '/public/images/catalog/', Input::file('image')->getFilename() . '.' . $extension);
                    $entry->userId = Auth::user()->id;
                    $entry->mime = Input::file('image')->getClientMimeType();
                    $entry->original_filename = Input::file('image')->getClientOriginalName();
                    $entry->filename = Input::file('image')->getFilename() . '.' . $extension;
                    $entry->country = Input::get('country');
                    $entry->state = Input::get('state');
                    $entry->city = Input::get('city');
                    $entry->profession = Input::get('profession');
                }
                else{
                    $entry->userId = Auth::user()->id;
                    $entry->mime = "";
                    $entry->original_filename = "";
                    $entry->filename = "";
                    $entry->country = Input::get('country');
                    $entry->state = Input::get('state');
                    $entry->city = Input::get('city');
                    $entry->profession = Input::get('profession');
                }
            }
            else{
                $entry->userId = Auth::user()->id;
                $entry->country = Input::get('country');
                $entry->state = Input::get('state');
                $entry->city = Input::get('city');
                $entry->profession = Input::get('profession');
            }
        }

        $entry->save();
        return redirect('/profile');

    }

    public function DateRange($reportId){

        $data = DB::table('criterias')->get();
        $data1 = DB::table('subCriterias')->get();
        $user = DB::table('users')->get();

        $id = DB::table('times')->where('reportId', $reportId)->value('id');
        $range = Input::get('range');
        $end = substr($range, strpos($range, '-')+2);

        $endDate = strtotime($end);
        $startDate = strtotime(DB::table('reports')->where('id', $reportId)->value('created_at'));
        if(!$id){
            $date = new Time();
        }
        else{
            $date = Time::FindOrNew($id);
        }
        $date->userId = Auth::user()->id;
        $date->reportId = $reportId;
        $date->start = $startDate;
        $date->end = $endDate;
        $date->save();

        return view('reportHome', compact('data','data1', 'user', 'reportId'));
    }

}
