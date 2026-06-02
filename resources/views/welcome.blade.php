<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>종로구 미술관 & 박물관 지도 비교 플랫폼</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --bg-color: #FAF9F6;
            --panel-bg: #FFFFFF;
            --text-main: #1A1A1A;
            --text-muted: #666666;
            --border-color: #E5E5E0;
            --primary: #8C7853;
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.04);
            --border-radius: 12px;
            --transition: all 0.2s ease;
            
            --google-color: #4285F4;
            --naver-color: #03C75A;
            --kakao-color: #FFCD00;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Outfit', 'Noto Sans KR', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            overflow: hidden;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Header Navigation */
        header {
            background-color: var(--panel-bg);
            border-bottom: 1px solid var(--border-color);
            padding: 16px 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 100;
            box-shadow: var(--shadow-sm);
        }

        .logo-area h1 {
            font-size: 20px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .logo-area h1 span {
            color: var(--primary);
            font-weight: 300;
        }

        .logo-area p {
            font-size: 11px;
            color: var(--text-muted);
            margin-top: 2px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .global-controls {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .control-group {
            display: flex;
            align-items: center;
            gap: 24px;
            background: #F4F3EF;
            padding: 8px 20px;
            border-radius: 30px;
            border: 1px solid var(--border-color);
            font-size: 13px;
            font-weight: 500;
        }

        .checkbox-container {
            display: flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
        }

        /* Main View Layout */
        .app-container {
            display: flex;
            flex: 1;
            height: calc(100vh - 77px);
        }

        /* Sidebar: Museum List */
        .sidebar {
            width: 360px;
            background-color: var(--panel-bg);
            border-right: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            z-index: 10;
        }

        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid var(--border-color);
        }

        .sidebar-title {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .museum-count {
            font-size: 12px;
            font-weight: 500;
            background-color: #F4F3EF;
            color: var(--primary);
            padding: 3px 8px;
            border-radius: 12px;
        }

        .search-wrapper {
            position: relative;
        }

        .search-wrapper i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 13px;
        }

        .search-input {
            width: 100%;
            padding: 10px 12px 10px 36px;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            background-color: #F8F8F6;
            font-size: 13px;
            outline: none;
        }

        .museum-list {
            flex: 1;
            overflow-y: auto;
            padding: 12px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .museum-item {
            padding: 14px;
            border-radius: var(--border-radius);
            border: 1px solid var(--border-color);
            background-color: #FFF;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .museum-item:hover, .museum-item.active {
            border-color: var(--primary);
            background-color: #FAF6EE;
        }

        .museum-item-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .museum-name {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-main);
        }

        .tag {
            font-size: 10px;
            font-weight: 700;
            padding: 2px 6px;
            border-radius: 4px;
        }

        .tag.art { background-color: rgba(140, 120, 83, 0.1); color: var(--primary); }
        .tag.museum { background-color: rgba(44, 62, 80, 0.1); color: var(--secondary); }

        .museum-address {
            font-size: 12px;
            color: var(--text-muted);
        }

        /* Maps Container Area */
        .maps-grid-container {
            flex: 1;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1px;
            background-color: var(--border-color);
        }

        .map-wrapper {
            background-color: #FFF;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .map-header {
            padding: 12px 16px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .map-title {
            font-size: 13px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .map-badge {
            font-size: 9px;
            font-weight: 700;
            color: #FFF;
            padding: 2px 6px;
            border-radius: 4px;
        }

        .map-badge.google { background-color: var(--google-color); }
        .map-badge.naver { background-color: var(--naver-color); }
        .map-badge.kakao { background-color: var(--kakao-color); color: #191919; }

        .map-view {
            flex: 1;
            width: 100%;
            height: 100%;
        }

        .map-iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        @media (max-width: 1024px) {
            .maps-grid-container {
                grid-template-columns: 1fr;
                grid-template-rows: repeat(3, 1fr);
            }
            .app-container {
                flex-direction: column-reverse;
            }
            .sidebar {
                width: 100%;
                height: 300px;
            }
            body {
                overflow: auto;
                height: auto;
            }
        }
    </style>
</head>
<body>

    <header>
        <div class="logo-area">
            <h1>Art & History <span>Map Comparer</span></h1>
            <p>Jongno-gu Art Galleries & Museums (Google, Naver, Kakao)</p>
        </div>
        <div class="global-controls">
            <div class="control-group">
                <label class="checkbox-container">
                    <input type="checkbox" id="cluster-toggle" checked>
                    <span>마커 클러스터 활성화</span>
                </label>
            </div>
        </div>
    </header>

    <div class="app-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-title">
                    전시 공간 목록
                    <span class="museum-count" id="list-count">0</span>
                </div>
                <div class="search-wrapper">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" id="search-bar" class="search-input" placeholder="이름 또는 주소로 검색...">
                </div>
            </div>
            <div class="museum-list" id="museum-list-container">
                <!-- Rendering from JS -->
            </div>
        </aside>

        <!-- Maps Grid -->
        <main class="maps-grid-container">
            <!-- Google Maps -->
            <div class="map-wrapper">
                <div class="map-header">
                    <div class="map-title">
                        <span class="map-badge google">Google</span> Google Maps
                    </div>
                </div>
                <div class="map-view">
                    <iframe 
                        id="google-iframe" 
                        class="map-iframe" 
                        src="https://maps.google.com/maps?q=종로구+박물관&z=14&output=embed">
                    </iframe>
                </div>
            </div>

            <!-- Naver Maps -->
            <div class="map-wrapper">
                <div class="map-header">
                    <div class="map-title">
                        <span class="map-badge naver">Naver</span> Naver Maps
                    </div>
                </div>
                <div class="map-view">
                    <iframe 
                        id="naver-iframe" 
                        class="map-iframe" 
                        src="https://map.naver.com/p/search/%EC%A2%85%EB%A1%9C%EA%B5%AC%20%EB%B0%95%EB%AC%BC%EA%B4%80?c=13.82,0,0,0,dh">
                    </iframe>
                </div>
            </div>

            <!-- Kakao Maps -->
            <div class="map-wrapper">
                <div class="map-header">
                    <div class="map-title">
                        <span class="map-badge kakao">Kakao</span> Kakao Maps
                    </div>
                </div>
                <div class="map-view">
                    <iframe 
                        id="kakao-iframe" 
                        class="map-iframe" 
                        src="https://map.kakao.com/?q=%EC%A2%85%EB%A1%9C%EA%B5%AC%20%EB%B0%95%EB%AC%BC%EA%B4%80">
                    </iframe>
                </div>
            </div>
        </main>
    </div>

    <!-- Inject Museum Data from Laravel -->
    <script>
        window.museumData = @json($museums);
    </script>

    <!-- Main Simple Routing Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            renderList(window.museumData);

            // Search Filter
            document.getElementById('search-bar').addEventListener('input', (e) => {
                const keyword = e.target.value.toLowerCase();
                const filtered = window.museumData.filter(m => 
                    m.name.toLowerCase().includes(keyword) || 
                    m.address.toLowerCase().includes(keyword)
                );
                renderList(filtered);
            });

            // Clean cluster toggle check placeholder
            document.getElementById('cluster-toggle').addEventListener('change', (e) => {
                const activeItem = document.querySelector('.museum-item.active');
                if (activeItem) {
                    const idx = activeItem.dataset.index;
                    selectMuseum(window.museumData[idx]);
                } else {
                    resetMaps();
                }
            });
        });

        function renderList(data) {
            const container = document.getElementById('museum-list-container');
            container.innerHTML = '';
            document.getElementById('list-count').textContent = data.length;

            data.forEach((m) => {
                const originalIndex = window.museumData.findIndex(item => item.id === m.id);
                const div = document.createElement('div');
                div.className = 'museum-item';
                div.dataset.index = originalIndex;
                div.onclick = () => {
                    document.querySelectorAll('.museum-item').forEach(el => el.classList.remove('active'));
                    div.classList.add('active');
                    selectMuseum(m);
                };

                div.innerHTML = `
                    <div class="museum-item-header">
                        <h3 class="museum-name">${m.name}</h3>
                        <span class="tag ${m.type}">${m.type === 'art' ? '미술관' : '박물관'}</span>
                    </div>
                    <p class="museum-address">${m.address}</p>
                `;
                container.appendChild(div);
            });
        }

        function selectMuseum(m) {
            // 1. Google Update (Embed query by name/coords)
            document.getElementById('google-iframe').src = `https://maps.google.com/maps?q=${m.lat},${m.lng}&z=16&output=embed`;

            // 2. Naver Update (Query-based Web Naver Map Search URL with params)
            document.getElementById('naver-iframe').src = `https://map.naver.com/p/search/${encodeURIComponent(m.name)}?c=13.82,0,0,0,dh`;

            // 3. Kakao Update (Query-based Web Kakao Map Search URL)
            document.getElementById('kakao-iframe').src = `https://map.kakao.com/?q=${encodeURIComponent(m.name)}`;
        }

        function resetMaps() {
            document.getElementById('google-iframe').src = "https://maps.google.com/maps?q=종로구+박물관&z=14&output=embed";
            document.getElementById('naver-iframe').src = "https://map.naver.com/p/search/%EC%A2%85%EB%A1%9C%EA%B5%AC%20%EB%B0%95%EB%AC%BC%EA%B4%80?c=13.82,0,0,0,dh";
            document.getElementById('kakao-iframe').src = "https://map.kakao.com/?q=%EC%A2%85%EB%A1%9C%EA%B5%AC%20%EB%B0%95%EB%AC%BC%EA%B4%80";
        }
    </script>
</body>
</html>
