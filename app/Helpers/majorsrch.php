<?php

class Masor
{

    public function getList($key = false)
    {
        $category = [
            "공공정책학전공",
            "글로벌비즈니스학과",
            "영미학과",
            "중국학과",
            "일본학과",
            "경영학과",
            "관광경영학과",
            "국제무역학과",
            "경영정보학과",
            "금융학과",
            "지식서비스경영학과",
            "융합경영학과",
            "식품영양학과",
            "의약생명공학과",
            "건강관리학과",
            "철학생명의료윤리학과",
            "역사문화학부-사학전공",
            "역사문화학부 - 고고미술사학전공",
            "한국어문학과",
            "교육학과",
            "아동학과",
            "분자유전공학과",
            "응용생물공학과",
            "식품생명공학과",
            "생명자원산업학과",
            "건축학과",
            "패션디자인학과",
            "도시계획공학과",
            "조경학과",
            "산업디자인학과",
            "정보수학과",
            "반도체학과",
            "화학과",
            "바이오메디컬학과",
            "건축공학과",
            "건설시스템공학과",
            "환경 · 에너지공학부 - 미래에너지공학전공",
            "환경 · 에너지공학부 - 환경안전전공",
            "전기공학과",
            "전자공학과",
            "기계공학과",
            "산업경영공학과",
            "조선해양플랜트공학과",
            "화학공학과",
            "신소재공학과",
            "미술학과",
            "공예학과",
            "음악학과",
            "체육학과",
            "태권도학과",
            "정치 · 사회학부 - 정치외교학전공",
            "정치 · 사회학부 - 사회학전공",
            "행정학과",
            "사회복지학과",
            "미디어커뮤니케이션학과",
            "경제학과",
            "경찰 · 소방학과",
            "중국 · 일본학부",
            "의예과",
            "간호학과",
            "컴퓨터공학과",
            "AI학과",

        ];

        return $key ? $category[$key] : $category;
    }


    public function getMajor($page, $keyword = ''): array
    {
        $list = $this->getList();
        $list = $keyword ? $this->search($list, $keyword) : $list;
        $data = $this->page($list, $page);

        return [
            'count' => count($list),
            'list' => $data
        ];
    }

    private function search($list, $keyword): array
    {
        $data = [];
        foreach ($list as $val) {
            if (strpos($val, $keyword) !== false) {
                $data[] = $val;
            }
        }

        return $data;
    }


    public function getLink($key): string
    {


        $list = [
            '공공정책학전공' => "",
            '글로벌비즈니스학과' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=2&empCurtState2Id=1",
            '영미학과' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=1&empCurtState2Id=6&srchMode=key&searchCode=%EC%98%81%EB%AF%B8&pageIndex=1",
            '중국학과' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=1&empCurtState2Id=5&srchMode=key&searchCode=%EC%A4%91%EA%B5%AD&pageIndex=1",
            '일본학과' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=1&empCurtState2Id=4&srchMode=key&searchCode=%EC%9D%BC%EB%B3%B8&pageIndex=1",
            '경영학과' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=2&empCurtState2Id=1&srchMode=key&searchCode=%EA%B2%BD%EC%98%81&pageIndex=1",
            '관광경영학과' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=2&empCurtState2Id=3&srchMode=key&searchCode=%EA%B4%80%EA%B4%91%EA%B2%BD%EC%98%81&pageIndex=1",
            '국제무역학과' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=2&empCurtState2Id=8&srchMode=key&searchCode=%EA%B5%AD%EC%A0%9C%EB%AC%B4%EC%97%AD&pageIndex=1",
            '경영정보학과' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=2&empCurtState2Id=1&srchMode=key&searchCode=%EA%B2%BD%EC%98%81%EC%A0%95%EB%B3%B4&pageIndex=1",
            '금융학과' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=2&empCurtState2Id=6&srchMode=key&searchCode=%EA%B8%88%EC%9C%B5&pageIndex=1",
            '지식서비스경영학과' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=2&empCurtState2Id=1&srchMode=key&searchCode=%EA%B2%BD%EC%98%81%ED%95%99%EA%B3%BC&pageIndex=1",
            '융합경영학과' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=2&empCurtState2Id=1&srchMode=key&searchCode=%EC%9C%B5%ED%95%A9%EA%B2%BD%EC%98%81&pageIndex=1",
            '식품영양학과' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=4&empCurtState2Id=9&srchMode=key&searchCode=%EC%8B%9D%ED%92%88%EC%98%81%EC%96%91&pageIndex=1",
            '의약생명공학과' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=4&empCurtState2Id=4&srchMode=key&searchCode=%EC%83%9D%EB%AA%85%EA%B3%B5%ED%95%99&pageIndex=1",
            '건강관리학과' => "",
            '철학생명의료윤리학과' => "",
            '역사문화학부-사학전공' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=1&empCurtState2Id=16&srchMode=key&searchCode=%EC%82%AC%ED%95%99&pageIndex=1",
            '역사문화학부 - 고고미술사학전공' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=1&empCurtState2Id=15&srchMode=key&searchCode=%EA%B3%A0%EA%B3%A0%EB%AF%B8%EC%88%A0&pageIndex=1",
            '한국어문학과' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=1&empCurtState2Id=2&srchMode=key&searchCode=%ED%95%9C%EA%B5%AD%EC%96%B4&pageIndex=1",
            '교육학과' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=3&empCurtState2Id=1&srchMode=key&searchCode=%EA%B5%90%EC%9C%A1&pageIndex=1",
            '아동학과' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=2&empCurtState2Id=11&srchMode=key&searchCode=%EC%95%84%EB%8F%99&pageIndex=1",
            '분자유전공학과' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=4&empCurtState2Id=4&srchMode=key&searchCode=%EC%9C%A0%EC%A0%84&pageIndex=1",
            '응용생물공학과' => "",
            '식품생명공학과' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=4&empCurtState2Id=9&srchMode=key&searchCode=%EC%8B%9D%ED%92%88%EC%83%9D%EB%AA%85&pageIndex=1",
            '생명자원산업학과' => "",
            '건축학과' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=5&empCurtState2Id=1&srchMode=key&searchCode=%EA%B1%B4%EC%B6%95&pageIndex=1",
            '패션디자인학과' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=7&empCurtState2Id=3&srchMode=key&searchCode=%ED%8C%A8%EC%85%98%EB%94%94%EC%9E%90%EC%9D%B8&pageIndex=1",
            '도시계획공학과' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=2&empCurtState2Id=14&srchMode=key&searchCode=%EB%8F%84%EC%8B%9C%EA%B3%84%ED%9A%8D&pageIndex=1",
            '조경학과' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=5&empCurtState2Id=3&srchMode=key&searchCode=%EC%A1%B0%EA%B2%BD&pageIndex=1",
            '산업디자인학과' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=7&empCurtState2Id=1&srchMode=key&searchCode=%EC%82%B0%EC%97%85%EB%94%94%EC%9E%90%EC%9D%B8&pageIndex=1",
            '정보수학과' => "",
            '반도체학과' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=5&empCurtState2Id=19&srchMode=key&searchCode=%EB%B0%98%EB%8F%84%EC%B2%B4&pageIndex=1",
            '화학과' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=4&empCurtState2Id=7&srchMode=key&searchCode=%ED%99%94%ED%95%99&pageIndex=1",
            '바이오메디컬학과' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=6&empCurtState2Id=14&srchMode=key&searchCode=%EB%B0%94%EC%9D%B4%EC%98%A4&pageIndex=1",
            '건축공학과' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=5&empCurtState2Id=2&srchMode=key&searchCode=%EA%B1%B4%EC%B6%95&pageIndex=1",
            '건설시스템공학과' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=5&empCurtState2Id=4&srchMode=key&searchCode=%EA%B1%B4%EC%84%A4%EC%8B%9C%EC%8A%A4%ED%85%9C&pageIndex=1",
            '환경 · 에너지공학부 - 미래에너지공학전공' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=5&empCurtState2Id=17&srchMode=key&searchCode=%EC%97%90%EB%84%88%EC%A7%80&pageIndex=1",
            '환경 · 에너지공학부 - 환경안전전공' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=5&empCurtState2Id=17&srchMode=key&searchCode=%EC%97%90%EB%84%88%EC%A7%80&pageIndex=1",
            '전기공학과' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=5&empCurtState2Id=12&srchMode=key&searchCode=%EC%A0%84%EA%B8%B0&pageIndex=1",
            '전자공학과' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=5&empCurtState2Id=13&srchMode=key&searchCode=%EC%A0%84%EC%9E%90&pageIndex=1",
            '기계공학과' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=5&empCurtState2Id=9&srchMode=key&searchCode=%EA%B8%B0%EA%B3%84&pageIndex=1",
            '산업경영공학과' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=5&empCurtState2Id=27&srchMode=key&searchCode=%EC%82%B0%EC%97%85%EA%B2%BD%EC%98%81&pageIndex=1",
            '조선해양플랜트공학과' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=5&empCurtState2Id=8&srchMode=key&searchCode=%EC%A1%B0%EC%84%A0%ED%95%B4%EC%96%91&pageIndex=1",
            '화학공학과' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=4&empCurtState2Id=7&srchMode=key&searchCode=%ED%99%94%ED%95%99&pageIndex=1",
            '신소재공학과' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=5&empCurtState2Id=21&srchMode=key&searchCode=%EC%8B%A0%EC%86%8C%EC%9E%AC&pageIndex=1",
            '미술학과' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=7&empCurtState2Id=13&srchMode=key&searchCode=%EB%AF%B8%EC%88%A0&pageIndex=1",
            '공예학과' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=7&empCurtState2Id=5&srchMode=key&searchCode=%EA%B3%B5%EC%98%88&pageIndex=1",
            '음악학과' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=7&empCurtState2Id=16&srchMode=key&searchCode=%EC%9D%8C%EC%95%85&pageIndex=1",
            '체육학과' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=7&empCurtState2Id=10&srchMode=key&searchCode=%EC%B2%B4%EC%9C%A1&pageIndex=1",
            '태권도학과' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=7&empCurtState2Id=10&srchMode=key&searchCode=%ED%83%9C%EA%B6%8C%EB%8F%84&pageIndex=1",
            '정치 · 사회학부 - 정치외교학전공' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=2&empCurtState2Id=18&srchMode=key&searchCode=%EC%A0%95%EC%B9%98%EC%99%B8%EA%B5%90&pageIndex=1",
            '정치 · 사회학부 - 사회학전공' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=2&empCurtState2Id=15&srchMode=key&searchCode=%EC%82%AC%ED%9A%8C%ED%95%99&pageIndex=1",
            '행정학과' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=2&empCurtState2Id=19&srchMode=key&searchCode=%ED%96%89%EC%A0%95&pageIndex=1",
            '사회복지학과' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=2&empCurtState2Id=10&srchMode=key&searchCode=%EC%82%AC%ED%9A%8C%EB%B3%B5%EC%A7%80&pageIndex=1",
            '미디어커뮤니케이션학과' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=2&empCurtState2Id=17&srchMode=key&searchCode=%EB%AF%B8%EB%94%94%EC%96%B4&pageIndex=1",
            '경제학과' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=2&empCurtState2Id=2&srchMode=key&searchCode=%EA%B2%BD%EC%A0%9C&pageIndex=1",
            '경찰 · 소방학과' => "",
            '중국 · 일본학부' => "",
            '의예과' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=6&empCurtState2Id=1&srchMode=key&searchCode=%EC%9D%98%EC%98%88&pageIndex=1",
            '간호학과' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=6&empCurtState2Id=4&srchMode=key&searchCode=%EA%B0%84%ED%98%B8&pageIndex=1",
            '컴퓨터공학과' => "https://www.work.go.kr/consltJobCarpa/srch/schdpt/schdptSrchDtl.do?empCurtState1Id=5&empCurtState2Id=22&srchMode=key&searchCode=%EC%BB%B4%ED%93%A8%ED%84%B0&pageIndex=1",
            'AI학과' => "",
        ];

        if(!array_key_exists($key, $list)) {
            return '';
        }

        return $list[$key];
    }

    private function page($list, $page): array
    {
        $cnt = 10;
        $start = $cnt * ($page - 1);
        $end = count($list) < $cnt ? count($list) + 1 : $start + $cnt;
        $data = [];


        for ($i = $start; $i < $end; $i++) {

            if (!array_key_exists($i, $list)) {
                continue;
            }

            $data[] = $list[$i];
        }

        return $data;
    }

}
