# 종로구 미술관 & 박물관 지도 비교 플랫폼 (Laravel 11 & GitHub Pages)

본 프로젝트는 고객사 시연용으로 제작된 **구글맵, 네이버맵, 카카오맵 3대 지도 API 비교 분석 플랫폼**입니다. 서울시 종로구의 주요 미술관 및 박물관 마커를 활용하여 각 지도 엔진의 시각적 요소, 마커 클러스터링(Clustering) 성능, 그리고 조작 인터랙션을 한눈에 대조할 수 있도록 설계되었습니다.

---

## 🎨 주요 특징 및 UX 요소

1. **3분할 비교 그리드**: 한 화면에 구글맵, 네이버맵, 카카오맵이 나란히 배치되어 렌더링 품질과 디테일을 직관적으로 비교할 수 있습니다.
2. **지도 화면 실시간 동기화 (Map Sync)**: 한 지도에서 드래그나 줌 인/아웃을 조작하면 다른 두 지도도 동일한 좌표와 줌 레벨로 완벽히 연동되어 움직입니다. (토글 옵션 제공)
3. **실시간 마커 클러스터러 (Marker Clustering)**: 종로구 내 밀집된 마커들을 그룹화하여 보여주며, 체크박스를 통해 실시간으로 클러스터 기능을 켜거나 끌 수 있습니다.
4. **엄선된 종로구 전시 공간 데이터 (14개소)**: 국립현대미술관, 서울공예박물관, 대림미술관, 환기미술관 등 종로구 내 핵심 문화 예술 공간 14개의 위치, 연락처, 홈페이지 주소가 등록되어 있습니다.
5. **실시간 검색 필터 및 사이드바**: 검색창을 통해 장소 이름이나 주소로 실시간 필터링이 가능하며, 리스트 아이템 클릭 시 세 지도가 동시에 해당 위치로 부드럽게 화면 이동(`panTo`)하며 정보 창(InfoWindow)을 엽니다.
6. **브라우저 로컬 저장소 기반 API 키 설정 (보안 최적화)**: API 키를 소스코드에 하드코딩하지 않습니다. 사용자 또는 고객사가 페이지 상단 **"API 키 설정"** 창에서 각자 발급받은 키를 임시 입력하면 브라우저(`localStorage`)에 암호화 저장되어 지도가 즉시 활성화됩니다.

---

## 🛠 기술 스택

* **Backend / Generation**: Laravel 11.x (PHP 8.2 이상 추천)
* **Frontend**: HTML5, Vanilla JS, CSS3 Custom Properties (Bespoke Gallery Theme)
* **Maps API**:
  * Google Maps JavaScript API (MarkerClusterer 연동)
  * Naver Maps API v3 (MarkerClustering 오픈소스 연동)
  * Kakao Maps SDK (서비스 내장 clusterer 라이브러리 연동)
* **Deployment**: GitHub Pages (Repository Root 호스팅 최적화)

---

## 🚀 로컬 실행 방법 (Laravel)

로컬 개발 환경에서 라라벨 서버를 구동하여 플랫폼을 테스트합니다.

1. **라라벨 로컬 서버 실행**:
   ```bash
   php artisan serve
   ```
2. **접속**: 브라우저를 열고 `http://localhost:8000`에 접속합니다.
3. **API 키 설정**: 상단 오른쪽 **"API 키 설정"** 버튼을 눌러 각 지도 API 키를 입력하면 세 지도가 활성화됩니다. (키가 없으면 최초 진입 시 자동으로 입력 모달이 뜹니다.)

---

## 📦 GitHub Pages 정적 빌드 및 배포 방법

GitHub Pages(`likerberi.github.io/daljin`)는 PHP 서버를 실행할 수 없는 정적 호스팅 서비스이므로, 라라벨 뷰를 정적 HTML 파일로 컴파일하여 배포해야 합니다. 본 프로젝트에는 이를 자동화한 커스텀 아티산 커맨드가 탑재되어 있으며, 결과물은 저장소 루트 디렉토리에 바로 위치합니다.

### 1단계: 정적 파일 컴파일 (Artisan Command)
아래 명령어를 실행하면 라라벨 웰컴 뷰를 렌더링하고, 종로구 데이터셋을 주입하여 루트 디렉토리에 `index.html` 파일 및 깃허브용 `.nojekyll` 파일을 자동으로 생성합니다.
```bash
php artisan export:static
```

### 2단계: Git 저장소 커밋 및 푸시
생성된 정적 배포 파일들을 Git 리포지토리에 푸시합니다.
```bash
git add index.html .nojekyll
git commit -m "Deploy: 종로구 지도 비교 정적 페이지 빌드"
git push origin main
```

### 3단계: GitHub Pages 호스팅 설정
1. GitHub 내 `daljin` 레포지토리의 **Settings** 탭으로 이동합니다.
2. 좌측 메뉴에서 **Pages**를 클릭합니다.
3. **Build and deployment** 섹션의 Source를 `Deploy from a branch`로 설정합니다.
4. Branch를 배포용 브라우저(`main` 또는 `master`)로 선택하고, 폴더 경로를 **`/(root)`**로 지정한 뒤 **Save**를 누릅니다.
5. 잠시 후 `https://likerberi.github.io/daljin/`에 정상적으로 호스팅됩니다.

---

## 🔑 지도 API 키 발급 및 도메인 등록 가이드

지도가 브라우저에서 정상 작동하려면 각 개발자 센터에서 API 키를 발급받고, **사용할 도메인을 권한 리스트(화이트리스트)에 반드시 등록**해야 합니다.

### 1. Google Maps API
* **발급처**: [Google Cloud Console](https://console.cloud.google.com/google/maps-apis/overview)
* **활성화 필요 API**: `Maps JavaScript API`
* **제한사항 (도메인 등록)**: 애플리케이션 제한사항에서 `웹사이트`를 선택하고 아래 두 도메인을 추가합니다.
  * `http://localhost:8000/*` (로컬 테스트용)
  * `https://likerberi.github.io/*` (배포 서버용)

### 2. Naver Maps API
* **발급처**: [Naver Cloud Platform](https://console.ncloud.com/naver-service/application)
* **서비스 선택**: AI·NAVER API -> `Maps` 서비스 체크
* **웹 서비스 URL (도메인 등록)**:
  * `http://localhost:8000`
  * `https://likerberi.github.io/daljin`

### 3. Kakao Maps API
* **발급처**: [Kakao Developers](https://developers.kakao.com/console/app)
* **어플리케이션 추가**: 앱 생성 후 `JavaScript 키`를 복사하여 사용합니다.
* **플랫폼 등록**: [앱 설정] -> [플랫폼] -> [Web 플랫폼 등록]에서 도메인 입력:
  * `http://localhost:8000`
  * `https://likerberi.github.io`
