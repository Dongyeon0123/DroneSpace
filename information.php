<?php
// 세션 시작
session_start();
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>국가자격증</title>
    <style>
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
            padding-bottom: 70px;
        }
        .showcase {
            background: #333 url('drone.jpg') no-repeat 0 -400px;
            text-align: center;
            color: #fff;
        }
        .showcase h1 {
            margin-top: 70px;
            font-size: 55px;
            margin-bottom: 10px;
        }
        .showcase p {
            font-size: 20px;
            margin-bottom: 50px;
        }
        .main-content {
            padding: 20px;
            background: #fff;
        }
        .main-content h2 {
            margin-top: 0;
        }
        .main-content ul {
            list-style: none;
            padding: 0;
        }
        .main-content ul li {
            background: #eee;
            margin: 5px 0;
            padding: 10px;
        }
        .footer {
            background: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <?php
        require_once "header.php";
    ?>
    <section class="showcase">
        <div class="container">
            <h1>드론 국가자격증</h1>
        </div>
    </section>

    <section class="main-content container">
        <h2>국가자격증안내</h2>
        <h3>초경량비행장치 멀티콥터(드론)자격증 이란?</h3>
        <p>초경량비행장치 멀티콥터(드론) 자격증은 UAV(무인항공기) 조작 능력의 공식적 인증을 제공하는 국가 공인 자격입니다. 이 자격증은 항공기 조종사에게 요구되는 항공법규 숙지, 기상학적 지식 습득, 비행 기술 및 운용 능력을 평가합니다.</p>
        <p>특히, 상업적 항공 촬영, 재난 구조 및 탐색 작업, 정밀 농업, 산업 시설 점검 등 다양한 응용 분야에서의 안전한 드론 운용을 보장하기 위해 제도화되었으며, 이론 교육과 함께 실질적인 조종 실습을 포함한 포괄적인 교육 과정을 거쳐, 공인된 평가 기준에 따라 자격증이 부여됩니다.</p>
        
        <h3>기본정보</h3>
        <table border="1" cellspacing="0" cellpadding="10">
            <tr>
                <th>자격분류</th>
                <td>국가전문자격증</td>
            </tr>
            <tr>
                <th>시행기관</th>
                <td>교통안전공단</td>
            </tr>
            <tr>
                <th>응시자격</th>
                <td>조종자 자격증 14세 이상, 지도조종자 및 실기평가자 18세 이상</td>
            </tr>
        </table>

        <h3>자격정보</h3>
        <table border="1" cellspacing="0" cellpadding="10">
            <tr>
                <th>초경량비행장치 무인멀티콥터(드론) 조종자</th>
                <td>교통안전공단에서 시행하는 무인멀티콥터 조종자 시험에 합격하여 자격을 취득한 사람</td>
            </tr>
            <tr>
                <th>무인멀티콥터</th>
                <td>사람이 타지 않고 원격 조종 또는 스스로 조종되는 비행체</td>
            </tr>
            <tr>
                <th>자격특징</th>
                <td>항공기는 조종사, 경량항공기는 경량항공기조종사, 초경량비행장치는 초경량비행장치 조종자라고 함</td>
            </tr>
        </table>

        <h3>자격 취득 기준 및 취득 절차</h3>
        <table border="1" cellspacing="0" cellpadding="10">
            <tr>
                <th>1종</th>
                <td>1종 기체를 조종한 시간 20시간 필요 (2종 자격 취득자는 5시간, 3종 자격 취득자는 3시간 이내 인정), 학과시험 및 실기시험 응시 및 합격, 비행교육 이수 필요</td>
            </tr>
            <tr>
                <th>2종</th>
                <td>1종 또는 2종 기체를 조종한 시간 10시간 필요 (3종 자격 취득자는 3시간 이내 인정), 학과시험 및 비행교육 이수 필요</td>
            </tr>
            <tr>
                <th>3종</th>
                <td>1종 또는 2종 또는 3종 기체를 조종한 시간 6시간 필요, 비행교육 이수 필요</td>
            </tr>
            <tr>
                <th>4종</th>
                <td>온라인 교육 이수 후 취득 가능(자격증명임)</td>
            </tr>
        </table>

        <h3>시험정보</h3>
        <table border="1" cellspacing="0" cellpadding="10">
            <tr>
                <th>응시자격</th>
                <td>14세 이상이며, 무인멀티콥터 총 비행경력 6~20시간 필요 (무인헬리콥터 자격소지자는 2분의 1시간)</td>
            </tr>
            <tr>
                <th>학과시험</th>
                <td>항공법규, 항공기상, 비행이론 및 운용 과목 컴퓨터를 통한 객관식 4지선다형으로 시행</td>
            </tr>
            <tr>
                <th>비행경력</th>
                <td>자격증 종류에 따라 다른 비행경력 요건이 필요함. 모든 경우에 국토부 인가를 받은 전문교육원 및 사설교육원에서 이수해야 함</td>
            </tr>
            <tr>
                <th>실기시험</th>
                <td>기체 및 조종자에 관한 사항, 기상·공역 및 비행장에 관한 사항, 일반지식 및 비상절차 등을 포함한 구술 및 실비행시험으로 시행(3종 제외)</td>
            </tr>
        </table>

        <h3>활용정보</h3>
        <table border="1" cellspacing="0" cellpadding="10">
            <tr>
                <th>조종 가능성</th>
                <td>종별 해당장치 자격취득 시 해당 최대이륙중량 장치 조종가능</td>
            </tr>
            <tr>
                <th>드론사업 활용</th>
                <td>2~150kg의 드론을 사용하여 방제사업, 항공촬영 등의 업무와 드론관련 드론사업을 하려면 드론조종자 자격증이 필요함.</td>
            </tr>
            <tr>
                <th>1종취득</th>
                <td>~150kg 드론을 조종가능 촬영업, 방제업, 공공기관 취업, 드론관련자 취업 군입대, 사업, 교육, 상위자격 지도조종자, 실기평가자 필수 취득자격</td>
            </tr>
            <tr>
                <th>2종취득</th>
                <td>~25kg 이하 드론을 조종가능 촬영, 방제, 등 취업, 취미 등</td>
            </tr>
            <tr>
                <th>3종취득</th>
                <td>~7kg 이하 드론을 조종가능 촬영, 소형방제드론 운용 취업, 취미 등</td>
            </tr>
            <tr>
                <th>4종취득</th>
                <td>~2kg 이하 드론을 조종가능 촬영, 취미 (공식적인 자격증 아님)</td>
            </tr>
        </table>

        <h3>자격증 관계도</h3>
        <table border="1" cellspacing="0" cellpadding="10">
            <tr>
                <th>항공기조종사</th>
                <td>항공기 조종사는 초경량비행장치 조종자 자격시험에 응시하는 경우, 학과시험을 면제받음.</td>
            </tr>
            <tr>
                <th>지도조종자</th>
                <td>지도조종자가 되기 위해서는 개인별 비행 또는 교육원 교관반 과정 이수 후, 100시간 비행경력을 준비하고, 교통안전공단에서 시행하는 교관과정 교육을 이수하며, 공단에 지도조종자 등록을 해야 함.</td>
            </tr>
            <tr>
                <th>실기평가 지도조종자</th>
                <td>실기평가 지도조종자가 되기 위해서는 개인별 비행 또는 교육원 교관반 과정 이수 후, 150시간 비행경력을 준비하고, 교통안전공단에서 시행하는 평가 교관과정 교육을 이수하며, 공단에 평가지도조종자 등록을 해야 함.</td>
            </tr>
        </table>

        <h3>자격증 응시 절차 및 비용</h3>
        <table border="1" cellspacing="0" cellpadding="10">
            <tr>
                <th>응시자격신청 (학과시험 합격여부 관계없음)</th>
                <td>
                    <ol>
                        <li>응시자격신청: 방문 or (인터넷신청 시) 증빙서류 스캔(운전면허, 신체검사)</li>
                        <li>응시자격심사: 법적 조건 충족여부 심사 3~7일 소요 (근무일 기준)</li>
                        <li>응시자격부여: 서류 확인 후 자격 부여</li>
                    </ol>
                </td>
            </tr>
            <tr>
                <th>학과시험</th>
                <td>
                    <ol>
                        <li>학과시험접수: 홈페이지 접수 (응시수수료 결제) 시험 장소/일자/시간 선택</li>
                        <li>학과시험응시: CBT 컴퓨터 시험 시행 (70점 이상)</li>
                        <li>합격자발표: 시험 종료 즉시 결과 발표 (공식결과 18:00) 합격유효 기간 2년</li>
                    </ol>
                </td>
            </tr>
            <tr>
                <th>학과시험 응시수수료</th>
                <td>수수료 48,400원 (부가세 포함) 인터넷 접수 시 온라인 결제(신용카드 및 체크카드, 실시간 계좌이체)로 납부하시면 됩니다.</td>
            </tr>
            <tr>
                <th>실기시험</th>
                <td>
                    <ol>
                        <li>실기시험접수: 홈페이지 접수 (응시수수료 결제) 시험 장소/일자/시간 선택</li>
                        <li>실기시험응시: 채점 항목의 모든 항목에서 "S" 등급 이상 합격</li>
                        <li>합격자발표: 시험 당일 18:00 이후 (결과 채점표 홈페이지 확인 가능)</li>
                    </ol>
                </td>
            </tr>
            <tr>
                <th>실기시험 응시수수료</th>
                <td>수수료 72,600원 (부가세 포함) 인터넷 접수 시 온라인 결제(신용카드 및 체크카드, 실시간 계좌이체)로 납부하시면 됩니다.</td>
            </tr>
            <tr>
                <th>사회적 약자 수수료 감면</th>
                <td>적용대상: 국민기초생활 보장법에 따른 수급자, 한부모가족지원법에 따른 보호대상자 감면제도. 적용 수수료: 증명서 (재)교부 및 수시 면제를 제외한 항공시험 응시수수료 50% 감면</td>
            </tr>
            <tr>
                <th>자격증신청</th>
                <td>
                    <ol>
                        <li>자격증 신청: 반명함 사진 1장, 보통 2종 이상 운전면허 사본 또는 항공 신체검사 증명서 (최종 합격 발표 이후 신청 가능 / 인터넷 또는 방문 신청)</li>
                        <li>발급수수료: 11,000원 (부가세 포함) 인터넷 ~7일 소요, 방문 시 ~20분 소요</li>
                    </ol>
                </td>
            </tr>
        </table>
    </section>
    <script>
        function toggleMenu() {
            var menuOverlay = document.getElementById('menuOverlay');
            menuOverlay.classList.toggle('show');
        }
        function closeMenu() {
            var menuOverlay = document.getElementById('menuOverlay');
            menuOverlay.classList.remove('show');  // 'show' 클래스를 제거하여 팝업 숨김
        }
    </script>
</body>
</html>
