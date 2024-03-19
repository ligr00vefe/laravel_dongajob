<?php

namespace App\View\Components;

use Illuminate\View\Component;

class WorknetPaging extends Component
{

    public $total_record;
    public $page;
    public $block_start;
    public $block_end;
    public $total_page;
    public $firstArea;
    public $secondArea;
    public $firstJob;
    public $secondJob;
    public $thirdJob;
    public $salTp;
    public $minPay;
    public $maxPay;
    public $education;
    public $prefCd;
    public $pref;
    public $career;
    public $regDt;
    public $minCareerM;
    public $maxCareerM;
    public $closeDt;
    public $regDate;
    public $keyword;
    public $view_count;

    public function __construct($record, $page, $firstArea, $secondArea, $firstJob, $secondJob, $thirdJob, $salTp, $minPay, $maxPay, $education, $prefCd, $pref, $career, $regDt, $minCareerM, $maxCareerM, $closeDt, $regDate, $keyword, $viewCount)
    {
        $this->total_record = $record;
        $this->page = $page;
        $this->firstArea = $firstArea;
        $this->secondArea = $secondArea;
        $this->firstJob = $firstJob;
        $this->secondJob = $secondJob;
        $this->thirdJob = $thirdJob;
        $this->salTp = $salTp;
        $this->minPay = $minPay;
        $this->maxPay = $maxPay;
        $this->education = $education;
        $this->prefCd = $prefCd;
        $this->pref = $pref;
        $this->career = $career;
        $this->regDt = $regDt;
        $this->minCareerM = $minCareerM;
        $this->maxCareerM = $maxCareerM;
        $this->closeDt = $closeDt;
        $this->regDate = $regDate;
        $this->keyword = $keyword;
        $this->view_count = $viewCount;


    }


    public function paging()
    {
        $list = 10;
        $block_cnt = 10;


        $block_num = ceil($this->page / $block_cnt);
        $this->block_start = (($block_num - 1) * $block_cnt) + 1; // 블록 시작 번호 ex) 10, 20, 30 ..
        $block_end = $this->block_start + $block_cnt - 1; // 블록 마지막 번호 ex) 9, 19, 29 ..


        $this->total_page = ceil($this->total_record / $list);
        $this->block_end = $block_end > $this->total_page ? $this->total_page : $block_end;
        $total_block = ceil($this->total_page / $block_cnt);
        $page_start = ($this->page - 1) * $list;

    }


    public function render()
    {
        $this->paging();


        return view('components.worknet-paging', [
            'start' => $this->block_start,
            'end' => $this->block_end,
            'total_page' => $this->total_page,
            'firstArea' => $this->firstArea,
            'secondArea' => $this->secondArea,
            'firstJob' => $this->firstJob,
            'secondJob' => $this->secondJob,
            'thirdJob' => $this->thirdJob,
            'salTp' => $this->salTp,
            'minPay' => $this->minPay,
            'maxPay' => $this->maxPay,
            'education' => $this->education,
            'prefCd' => $this->prefCd,
            'pref' => $this->pref,
            'career' => $this->career,
            'regDt' => $this->regDt,
            'minCareerM' => $this->minCareerM,
            'maxCareerM' => $this->maxCareerM,
            'closeDt' => $this->closeDt,
            'regDate' => $this->regDate,
            'keyword' => $this->keyword,
            'view_count' => $this->view_count,
        ]);
    }
}
