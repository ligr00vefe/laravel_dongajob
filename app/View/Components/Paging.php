<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Paging extends Component
{

    public $total_record;
    public $page;
    public $block_start;
    public $block_end;
    public $total_page;
    public $keyword;

    public function __construct($record, $page, $keyword)
    {
        $this->total_record = $record;
        $this->page = $page;
        $this->keyword = $keyword;

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


        return view('components.paging', [
            'start' => $this->block_start,
            'end' => $this->block_end,
            'total_page' => $this->total_page
        ]);
    }
}
