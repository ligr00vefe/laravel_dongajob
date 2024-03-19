1. 배치 방법은 eXSignOn Token 매뉴얼 참고

2. 샘플의 기본적인 배치 위치는 common, include, lib, sample, sso 디렉토리가 전부 DocumentRoot/exsignon 바로 아래 있는것으로 가정.
   배치 위치를 수정 할 경우 php 파일 내부의 요청 URL 수정이 필요하다.
   
3. php 테스트 환경

3-1. php 설치
   - 테스트 버전 : php-5.4.30-Win32-VC9-x86
   
3-2. php 설정
   - %PHP_PATH%는 php 설치 경로
   
   - %PHP_PATH%/php.ini-development를 php.ini로 변경
   - php.ini 수정
     - extension=php_curl.dll 주석 해제
     - extension_dir 지정
       -> extension_dir = "%PHP_PATH%/ext"
     - timezone 수정
       -> date.timezone = Asia/Seoul

3-3. apache설치
   - 테스트 버전 : httpd-2.2.25-win32-x86-openssl
   - httpd.conf 수정
     - php 관련 설정 추가
       -> LoadModule php5_module "%PHP_PATH%/php5apache2_2.dll"
       
          AddHandler application/x-httpd-php .php
          PHPIniDir "%PHP_PATH%"

          <FilesMatch \.php$>
            SetHandler application/x-httpd-php
          </FilesMatch>
   - document root 수정

3-4. php 구동 테스트
   - document root에 아래 내용이 포함 된 php 배치
     <?php
       phpinfo();
     ?>
     
   - apache 재구동
     
   - php 설치 정보가 제대로 출력 될 경우 cURL 모듈 로드 정보 확인
     - cURL support가 enabled 되어 있는지 확인
     
   - php 설치 정보가 나오지 않을 경우 php 설치가 잘못 되었으므로 설치 확인