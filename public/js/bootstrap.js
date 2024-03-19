window.addEventListener('load', () => {

    //--- 헤더 마우스 over시 드롭 메뉴 활성화
    document.querySelector('.navi_list').addEventListener('mouseover', (e) => {
        menuDrop(e.target, e.type);
    });

    //--- 헤더 마우스 out시 드롭 메뉴 비활성화
    document.querySelector('.navi_list').addEventListener('mouseout', (e) => {
        menuDrop(e.target, e.type);
    });
     
});


//--- 드롭메뉴 활성화 이벤트 함수
function menuDrop(target, type) {

     //--- 메뉴명 over가 아니면 빠꾸
    if(target.nodeName != "SPAN") return;
    
    if(type == 'mouseover')
        document.querySelector('.header_menu').classList.add('on');
    else 
        document.querySelector('.header_menu').classList.remove('on');
}
