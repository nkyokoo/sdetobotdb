<?php


if (isset($_SESSION['user'])) {
    echo "
      <nav class='navbar navbar-expand-lg navbar-light bg-light' onclick='' style='background: rgb(217,217,217)    !important;'>
          <a class='navbar-brand' style='' href='/'><svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 2560.38 682.3\"><title>logo</title><path d=\"M317.27,1162.68h33.24l-36.22,155.86H255.84l-36.22-155.86h33.24L279.91,1291h10.31Zm53.87,155.86V1162.68h31.63v155.86Zm118,0H436.69V1162.68h52.49q20.16,0,33.23,4.23t20.29,14a57.71,57.71,0,0,1,10,22.91q2.75,13.18,2.75,34.27t-2.52,35a67.71,67.71,0,0,1-9.51,24.76q-7,10.88-20.29,15.81T489.18,1318.54Zm33.23-61.89q.47-7.32.46-20.29a186.05,186.05,0,0,0-.91-20.73,39.91,39.91,0,0,0-4.36-14.22,18.11,18.11,0,0,0-10.2-8.82q-6.76-2.41-18.22-2.41H468.32V1291h20.86q17.19,0,25-8.71Q520.81,1275.22,522.41,1256.65Zm60.51,61.89V1162.68H683.78v27.5H614.56v36.45H670v27H614.56V1291h69.22v27.51Zm127,0V1162.68h53.4L800.9,1291h2.3V1162.68h31.63v155.86h-52l-39-128.36h-2.29v128.36Zm206.75-131.11q-25,0-25,16.51a12.5,12.5,0,0,0,6.19,11.23q6.2,3.88,29,11.22t32,16.63q9.17,9.27,9.17,28.54,0,24.53-14.9,37.12t-39,12.61q-17.88,0-43.77-5.5l-8.25-1.6,3.2-24.53q30.72,4.13,47,4.13,24.3,0,24.3-20.18a13.39,13.39,0,0,0-5.62-11.45q-5.62-4.12-22.35-9-26.6-7.55-37.47-18t-10.89-29q0-23.37,14.21-34.83t39-11.47q17,0,43.09,4.59l8.25,1.61-2.52,25Q930,1187.43,916.66,1187.43ZM1092.23,1316q-24.3,5.26-43.78,5.27t-31.17-4.81a38.46,38.46,0,0,1-18.34-15.36,68.32,68.32,0,0,1-9.17-24.75q-2.52-14.2-2.52-35.76,0-45.15,12.72-62.93t46.88-17.76q19.71,0,45.61,6.2l-.92,25.21q-22.69-3.45-37.7-3.44t-21.43,4q-6.42,4-9.51,15.24t-3.1,38.28q0,27.06,6.31,37.48t25.21,10.43a270.51,270.51,0,0,0,40.22-3.21Zm25.68,2.52V1162.68h100.85v27.5h-69.22v36.45H1205v27h-55.47V1291h69.22v27.51Zm127,0V1162.68h53.4L1335.88,1291h2.3V1162.68h31.63v155.86h-52l-39-128.36h-2.29v128.36Zm144.86-127.9v-28h114.61v28H1463.1v127.9h-31.63v-127.9Zm134.54,127.9V1162.68h100.86v27.5h-69.22v36.45h55.47v27h-55.47V1291h69.22v27.51Zm158.62-52.26v52.26h-31.64V1162.68h60.51q55,0,55,51.34,0,30.49-22.93,44.92l22.25,59.6H1731.5l-18.11-52.26Zm46.07-33.93q5.51-6.87,5.5-18.1t-5.85-17.88q-5.84-6.64-16.85-6.65h-28.87v49.51h29.34C1719.73,1239.23,1725.32,1236.94,1729,1232.35Zm114.84,86.19V1162.68h99.48v27.5h-67.85V1236h55.48v27.5h-55.48v55Zm229.55-16.62q-14.53,19.38-50.08,19.37t-50.08-19.37q-14.55-19.35-14.56-60.62t14.56-61.32q14.55-20.06,50.08-20.06t50.08,20.06q14.57,20.05,14.56,61.32T2073.37,1301.92Zm-75.4-20.17q6.75,12,25.32,12t25.33-12q6.75-12,6.76-40.34t-6.88-41.15q-6.86-12.83-25.21-12.83t-25.21,12.83q-6.88,12.85-6.88,41.15T1998,1281.75Zm148.64-15.47v52.26H2115V1162.68h60.51q55,0,55,51.34,0,30.49-22.92,44.92l22.24,59.6H2195.2l-18.11-52.26Zm46.07-33.93q5.51-6.87,5.5-18.1t-5.85-17.88q-5.84-6.64-16.84-6.65h-28.88v49.51H2176C2183.43,1239.23,2189,1236.94,2192.68,1232.35ZM219.85,1579l35.08-155.87H315L350.05,1579H318.42l-6.19-28.2H257.67l-6.18,28.2Zm59.6-129.74-15.81,74h42.63l-15.82-74ZM400,1527q0,27.27,27.73,27.28T455.48,1527V1423.15h31.64v103.14q0,28.67-14.79,42.06t-44.58,13.41q-29.81,0-44.58-13.41t-14.79-42.06V1423.15H400Zm105.67-75.87v-28h114.6v28H579V1579H547.4V1451.11Zm241,111.28q-14.57,19.38-50.09,19.37t-50.08-19.37Q632,1543,632,1501.77t14.56-61.31q14.57-20.06,50.08-20.07t50.09,20.07q14.55,20.05,14.55,61.31T746.7,1562.39Zm-75.41-20.17q6.75,12,25.32,12t25.33-12q6.76-12,6.77-40.34t-6.88-41.15q-6.89-12.82-25.22-12.83t-25.21,12.83q-6.87,12.86-6.88,41.15T671.29,1542.22Zm117,36.8V1423.15h53.86l27.51,113.69,27.51-113.69H951V1579H919.41V1458.45H916l-30.48,113.69H853.85l-30.48-113.69h-3.44V1579Zm183.6,0L1007,1423.15h60L1102.1,1579h-31.64l-6.18-28.2h-54.56l-6.19,28.2Zm59.6-129.74-15.82,74h42.63l-15.81-74Zm69,1.83v-28H1215.1v28h-41.26V1579h-31.63V1451.11ZM1235,1579V1423.15h31.63V1579Zm173.4-16.63q-14.57,19.38-50.09,19.37t-50.08-19.37q-14.57-19.35-14.56-60.62t14.56-61.31q14.55-20.06,50.08-20.07t50.09,20.07q14.55,20.05,14.55,61.31T1408.44,1562.39ZM1333,1542.22q6.75,12,25.32,12t25.33-12q6.77-12,6.76-40.34t-6.88-41.15q-6.87-12.82-25.21-12.83t-25.21,12.83q-6.89,12.86-6.88,41.15T1333,1542.22Zm117,36.8V1423.15h53.41L1541,1551.5h2.29V1423.15H1575V1579h-52l-39-128.37h-2.29V1579Zm317.1-16.63q-14.54,19.38-50.08,19.37T1667,1562.39q-14.55-19.35-14.56-60.62t14.56-61.31q14.55-20.06,50.08-20.07t50.08,20.07q14.56,20.05,14.56,61.31T1767.14,1562.39Zm-75.4-20.17q6.77,12,25.32,12t25.33-12q6.77-12,6.77-40.34t-6.88-41.15q-6.87-12.82-25.22-12.83t-25.21,12.83q-6.88,12.86-6.88,41.15T1691.74,1542.22Zm181.87-19.13v-27.51H1919v80.91q-32.77,5.27-53.17,5.27-36.45,0-50.09-19.48t-13.64-61.88q0-42.42,14.21-61.21t48.37-18.8a243,243,0,0,1,46.07,4.81l8.25,1.61-.91,24.53q-27.51-3-45-3t-24.64,4.12q-7.1,4.14-10.43,15.24t-3.32,38.06q0,26.94,6.65,37.71t27.5,10.77l19-.92v-30.25ZM264.55,1787.22v52.26H232.92V1683.61h60.51q55,0,55,51.34,0,30.49-22.92,44.93l22.23,59.6h-34.6L295,1787.22Zm46.07-33.93q5.5-6.87,5.5-18.1t-5.84-17.88q-5.85-6.66-16.85-6.65H264.55v49.51h29.34Q305.11,1760.17,310.62,1753.29Zm172.26,69.57q-14.56,19.37-50.09,19.36t-50.08-19.36q-14.55-19.36-14.56-60.63t14.56-61.31q14.57-20.06,50.08-20.06t50.09,20.06q14.55,20.05,14.55,61.31T482.88,1822.86Zm-75.41-20.17q6.75,12,25.32,12t25.33-12q6.76-12,6.77-40.35T458,1721.21q-6.88-12.84-25.22-12.84t-25.21,12.84q-6.87,12.82-6.88,41.13T407.47,1802.69Zm117-119.08h61.2q24.3,0,36.45,9.74t12.14,31.52q0,13.07-3.89,20.75t-13.3,13.63q10.32,4.37,15.25,12.61t4.92,22.92q0,22.7-13.29,33.7t-37.36,11H524.48Zm59.6,27.05h-28v37.13h28.2q17.88,0,17.87-18.57T584.08,1710.66Zm.91,63.72H556.11v38H585q10.32,0,15.24-4.13t4.93-15.13Q605.16,1774.39,585,1774.38Zm186.92,48.48q-14.55,19.37-50.08,19.36t-50.08-19.36q-14.57-19.36-14.56-60.63t14.56-61.31q14.55-20.06,50.08-20.06t50.08,20.06q14.55,20.05,14.56,61.31T771.91,1822.86Zm-75.41-20.17q6.75,12,25.33,12t25.33-12q6.75-12,6.76-40.35T747,1721.21q-6.87-12.84-25.21-12.84t-25.22,12.84q-6.87,12.82-6.87,41.13T696.5,1802.69Zm101.43-91.12v-28H912.54v28H871.28v127.91H839.65V1711.57Zm120.57,0v-28h114.61v28H991.85v127.91H960.21V1711.57ZM1053,1839.48V1683.61H1153.9v27.5h-69.23v36.45h55.47v27h-55.47V1812h69.23v27.5Zm158.62,0H1180V1683.61h31.64v68.54l21.08-2.29,25.67-66.25h36l-33.92,78.16,34.84,77.71h-36.45l-26.13-62.12-21.08,2.29Zm104.28,0V1683.61h53.41L1406.94,1812h2.29V1683.61h31.64v155.87h-52l-39-128.37h-2.28v128.37Zm266.7-16.62q-14.57,19.37-50.08,19.36t-50.08-19.36q-14.58-19.36-14.57-60.63t14.57-61.31q14.52-20.06,50.08-20.06t50.08,20.06q14.55,20.05,14.55,61.31T1582.64,1822.86Zm-75.42-20.17q6.78,12,25.34,12t25.31-12q6.78-12,6.78-40.35t-6.88-41.13q-6.87-12.84-25.21-12.84t-25.22,12.84q-6.9,12.82-6.87,41.13T1507.22,1802.69Zm205.72,36.79h-88.7V1683.61h31.63v127.91h57.07Zm126-16.62q-14.55,19.37-50.08,19.36t-50.08-19.36q-14.57-19.36-14.56-60.63t14.56-61.31q14.54-20.06,50.08-20.06t50.08,20.06q14.55,20.05,14.56,61.31T1838.89,1822.86Zm-75.41-20.17q6.76,12,25.33,12t25.32-12q6.76-12,6.77-40.35t-6.88-41.13q-6.87-12.84-25.21-12.84t-25.22,12.84q-6.88,12.82-6.87,41.13T1763.48,1802.69Zm181.87-19.14V1756h45.39V1837q-32.77,5.28-53.17,5.27-36.45,0-50.09-19.48t-13.63-61.88q0-42.4,14.2-61.2t48.37-18.8a241.41,241.41,0,0,1,46.07,4.82l8.25,1.59-.91,24.54q-27.51-3-45-3t-24.64,4.13q-7.1,4.13-10.43,15.25t-3.32,38q0,26.94,6.65,37.71t27.5,10.77l19-.91v-30.26Zm75.19,55.93V1683.61h31.64v155.87Zm759.46-93.7v96.44H2404.74v-96.44h62l-114.66-108.35a130.63,130.63,0,0,0,107-95l215,203.32Zm-361.65-237.12a85,85,0,1,1-85-85A85,85,0,0,1,2418.35,1508.66Zm-51,0a33.91,33.91,0,1,0-33.91,33.9A33.91,33.91,0,0,0,2367.3,1508.66Zm307.62-297a16.32,16.32,0,0,0-5.48-.85,17.66,17.66,0,0,0-17,12.53l-25.9,70.65a20.43,20.43,0,0,1-9.58,12.11l-36.12,21.17-65.07-65.07,18.74-32.22a21.35,21.35,0,0,1,12.22-9.59l70.54-25.9a17.71,17.71,0,0,0,12.64-16.84,16.57,16.57,0,0,0-.84-5.48,17.75,17.75,0,0,0-21.91-11.48l-83.81,29.91a21.35,21.35,0,0,0-12.21,9.58L2490,1236.37l-11.26-11.27-34.65,34.64,15.8,15.8-99.82,105.61a130.65,130.65,0,0,1,99.19,94.55l3.89,3.79,97.51-103.08,23.16,23.16,34.75-34.74-11.9-11.9,40.11-23.48a20.41,20.41,0,0,0,9.59-12.11l29.9-83.81A17.59,17.59,0,0,0,2674.92,1211.63Z\" transform=\"translate(-219.62 -1159.92)\"/></svg></a>
             <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
                 <span class='navbar-toggler-icon'></span>
            </button>
        <div class='collapse navbar-collapse' id='navbarSupportedContent'>
         <ul class='navbar-nav mr-auto'>
				<li class='nav-item'><a class='nav-link'  style='position: relative; float: right' href='../user/'>"; echo $_SESSION['user']['name'] ; echo "</a></li>
              </ul>
          </div>
            <button type='button' class='btn btn-secondary' onclick=\"window.location.replace('/cart.php')\" data-toggle='tooltip' data-placement='top' title='kurv'  style='position: relative; float: right'><span id='cartItemCount' class=\"badge badge-pill badge-primary\"></span><i class='material-icons' style='height: 20px'>shopping_cart</i></button>
      </nav>";
}else{
    echo "

      <nav class='navbar navbar-expand-lg navbar-dark bg-dark' style='background: rgb(24,24,24)  !important;'>
          <a class='navbar-brand' style='' href='/'><svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 2560.38 682.3\"><title>logo</title><path d=\"M317.27,1162.68h33.24l-36.22,155.86H255.84l-36.22-155.86h33.24L279.91,1291h10.31Zm53.87,155.86V1162.68h31.63v155.86Zm118,0H436.69V1162.68h52.49q20.16,0,33.23,4.23t20.29,14a57.71,57.71,0,0,1,10,22.91q2.75,13.18,2.75,34.27t-2.52,35a67.71,67.71,0,0,1-9.51,24.76q-7,10.88-20.29,15.81T489.18,1318.54Zm33.23-61.89q.47-7.32.46-20.29a186.05,186.05,0,0,0-.91-20.73,39.91,39.91,0,0,0-4.36-14.22,18.11,18.11,0,0,0-10.2-8.82q-6.76-2.41-18.22-2.41H468.32V1291h20.86q17.19,0,25-8.71Q520.81,1275.22,522.41,1256.65Zm60.51,61.89V1162.68H683.78v27.5H614.56v36.45H670v27H614.56V1291h69.22v27.51Zm127,0V1162.68h53.4L800.9,1291h2.3V1162.68h31.63v155.86h-52l-39-128.36h-2.29v128.36Zm206.75-131.11q-25,0-25,16.51a12.5,12.5,0,0,0,6.19,11.23q6.2,3.88,29,11.22t32,16.63q9.17,9.27,9.17,28.54,0,24.53-14.9,37.12t-39,12.61q-17.88,0-43.77-5.5l-8.25-1.6,3.2-24.53q30.72,4.13,47,4.13,24.3,0,24.3-20.18a13.39,13.39,0,0,0-5.62-11.45q-5.62-4.12-22.35-9-26.6-7.55-37.47-18t-10.89-29q0-23.37,14.21-34.83t39-11.47q17,0,43.09,4.59l8.25,1.61-2.52,25Q930,1187.43,916.66,1187.43ZM1092.23,1316q-24.3,5.26-43.78,5.27t-31.17-4.81a38.46,38.46,0,0,1-18.34-15.36,68.32,68.32,0,0,1-9.17-24.75q-2.52-14.2-2.52-35.76,0-45.15,12.72-62.93t46.88-17.76q19.71,0,45.61,6.2l-.92,25.21q-22.69-3.45-37.7-3.44t-21.43,4q-6.42,4-9.51,15.24t-3.1,38.28q0,27.06,6.31,37.48t25.21,10.43a270.51,270.51,0,0,0,40.22-3.21Zm25.68,2.52V1162.68h100.85v27.5h-69.22v36.45H1205v27h-55.47V1291h69.22v27.51Zm127,0V1162.68h53.4L1335.88,1291h2.3V1162.68h31.63v155.86h-52l-39-128.36h-2.29v128.36Zm144.86-127.9v-28h114.61v28H1463.1v127.9h-31.63v-127.9Zm134.54,127.9V1162.68h100.86v27.5h-69.22v36.45h55.47v27h-55.47V1291h69.22v27.51Zm158.62-52.26v52.26h-31.64V1162.68h60.51q55,0,55,51.34,0,30.49-22.93,44.92l22.25,59.6H1731.5l-18.11-52.26Zm46.07-33.93q5.51-6.87,5.5-18.1t-5.85-17.88q-5.84-6.64-16.85-6.65h-28.87v49.51h29.34C1719.73,1239.23,1725.32,1236.94,1729,1232.35Zm114.84,86.19V1162.68h99.48v27.5h-67.85V1236h55.48v27.5h-55.48v55Zm229.55-16.62q-14.53,19.38-50.08,19.37t-50.08-19.37q-14.55-19.35-14.56-60.62t14.56-61.32q14.55-20.06,50.08-20.06t50.08,20.06q14.57,20.05,14.56,61.32T2073.37,1301.92Zm-75.4-20.17q6.75,12,25.32,12t25.33-12q6.75-12,6.76-40.34t-6.88-41.15q-6.86-12.83-25.21-12.83t-25.21,12.83q-6.88,12.85-6.88,41.15T1998,1281.75Zm148.64-15.47v52.26H2115V1162.68h60.51q55,0,55,51.34,0,30.49-22.92,44.92l22.24,59.6H2195.2l-18.11-52.26Zm46.07-33.93q5.51-6.87,5.5-18.1t-5.85-17.88q-5.84-6.64-16.84-6.65h-28.88v49.51H2176C2183.43,1239.23,2189,1236.94,2192.68,1232.35ZM219.85,1579l35.08-155.87H315L350.05,1579H318.42l-6.19-28.2H257.67l-6.18,28.2Zm59.6-129.74-15.81,74h42.63l-15.82-74ZM400,1527q0,27.27,27.73,27.28T455.48,1527V1423.15h31.64v103.14q0,28.67-14.79,42.06t-44.58,13.41q-29.81,0-44.58-13.41t-14.79-42.06V1423.15H400Zm105.67-75.87v-28h114.6v28H579V1579H547.4V1451.11Zm241,111.28q-14.57,19.38-50.09,19.37t-50.08-19.37Q632,1543,632,1501.77t14.56-61.31q14.57-20.06,50.08-20.07t50.09,20.07q14.55,20.05,14.55,61.31T746.7,1562.39Zm-75.41-20.17q6.75,12,25.32,12t25.33-12q6.76-12,6.77-40.34t-6.88-41.15q-6.89-12.82-25.22-12.83t-25.21,12.83q-6.87,12.86-6.88,41.15T671.29,1542.22Zm117,36.8V1423.15h53.86l27.51,113.69,27.51-113.69H951V1579H919.41V1458.45H916l-30.48,113.69H853.85l-30.48-113.69h-3.44V1579Zm183.6,0L1007,1423.15h60L1102.1,1579h-31.64l-6.18-28.2h-54.56l-6.19,28.2Zm59.6-129.74-15.82,74h42.63l-15.81-74Zm69,1.83v-28H1215.1v28h-41.26V1579h-31.63V1451.11ZM1235,1579V1423.15h31.63V1579Zm173.4-16.63q-14.57,19.38-50.09,19.37t-50.08-19.37q-14.57-19.35-14.56-60.62t14.56-61.31q14.55-20.06,50.08-20.07t50.09,20.07q14.55,20.05,14.55,61.31T1408.44,1562.39ZM1333,1542.22q6.75,12,25.32,12t25.33-12q6.77-12,6.76-40.34t-6.88-41.15q-6.87-12.82-25.21-12.83t-25.21,12.83q-6.89,12.86-6.88,41.15T1333,1542.22Zm117,36.8V1423.15h53.41L1541,1551.5h2.29V1423.15H1575V1579h-52l-39-128.37h-2.29V1579Zm317.1-16.63q-14.54,19.38-50.08,19.37T1667,1562.39q-14.55-19.35-14.56-60.62t14.56-61.31q14.55-20.06,50.08-20.07t50.08,20.07q14.56,20.05,14.56,61.31T1767.14,1562.39Zm-75.4-20.17q6.77,12,25.32,12t25.33-12q6.77-12,6.77-40.34t-6.88-41.15q-6.87-12.82-25.22-12.83t-25.21,12.83q-6.88,12.86-6.88,41.15T1691.74,1542.22Zm181.87-19.13v-27.51H1919v80.91q-32.77,5.27-53.17,5.27-36.45,0-50.09-19.48t-13.64-61.88q0-42.42,14.21-61.21t48.37-18.8a243,243,0,0,1,46.07,4.81l8.25,1.61-.91,24.53q-27.51-3-45-3t-24.64,4.12q-7.1,4.14-10.43,15.24t-3.32,38.06q0,26.94,6.65,37.71t27.5,10.77l19-.92v-30.25ZM264.55,1787.22v52.26H232.92V1683.61h60.51q55,0,55,51.34,0,30.49-22.92,44.93l22.23,59.6h-34.6L295,1787.22Zm46.07-33.93q5.5-6.87,5.5-18.1t-5.84-17.88q-5.85-6.66-16.85-6.65H264.55v49.51h29.34Q305.11,1760.17,310.62,1753.29Zm172.26,69.57q-14.56,19.37-50.09,19.36t-50.08-19.36q-14.55-19.36-14.56-60.63t14.56-61.31q14.57-20.06,50.08-20.06t50.09,20.06q14.55,20.05,14.55,61.31T482.88,1822.86Zm-75.41-20.17q6.75,12,25.32,12t25.33-12q6.76-12,6.77-40.35T458,1721.21q-6.88-12.84-25.22-12.84t-25.21,12.84q-6.87,12.82-6.88,41.13T407.47,1802.69Zm117-119.08h61.2q24.3,0,36.45,9.74t12.14,31.52q0,13.07-3.89,20.75t-13.3,13.63q10.32,4.37,15.25,12.61t4.92,22.92q0,22.7-13.29,33.7t-37.36,11H524.48Zm59.6,27.05h-28v37.13h28.2q17.88,0,17.87-18.57T584.08,1710.66Zm.91,63.72H556.11v38H585q10.32,0,15.24-4.13t4.93-15.13Q605.16,1774.39,585,1774.38Zm186.92,48.48q-14.55,19.37-50.08,19.36t-50.08-19.36q-14.57-19.36-14.56-60.63t14.56-61.31q14.55-20.06,50.08-20.06t50.08,20.06q14.55,20.05,14.56,61.31T771.91,1822.86Zm-75.41-20.17q6.75,12,25.33,12t25.33-12q6.75-12,6.76-40.35T747,1721.21q-6.87-12.84-25.21-12.84t-25.22,12.84q-6.87,12.82-6.87,41.13T696.5,1802.69Zm101.43-91.12v-28H912.54v28H871.28v127.91H839.65V1711.57Zm120.57,0v-28h114.61v28H991.85v127.91H960.21V1711.57ZM1053,1839.48V1683.61H1153.9v27.5h-69.23v36.45h55.47v27h-55.47V1812h69.23v27.5Zm158.62,0H1180V1683.61h31.64v68.54l21.08-2.29,25.67-66.25h36l-33.92,78.16,34.84,77.71h-36.45l-26.13-62.12-21.08,2.29Zm104.28,0V1683.61h53.41L1406.94,1812h2.29V1683.61h31.64v155.87h-52l-39-128.37h-2.28v128.37Zm266.7-16.62q-14.57,19.37-50.08,19.36t-50.08-19.36q-14.58-19.36-14.57-60.63t14.57-61.31q14.52-20.06,50.08-20.06t50.08,20.06q14.55,20.05,14.55,61.31T1582.64,1822.86Zm-75.42-20.17q6.78,12,25.34,12t25.31-12q6.78-12,6.78-40.35t-6.88-41.13q-6.87-12.84-25.21-12.84t-25.22,12.84q-6.9,12.82-6.87,41.13T1507.22,1802.69Zm205.72,36.79h-88.7V1683.61h31.63v127.91h57.07Zm126-16.62q-14.55,19.37-50.08,19.36t-50.08-19.36q-14.57-19.36-14.56-60.63t14.56-61.31q14.54-20.06,50.08-20.06t50.08,20.06q14.55,20.05,14.56,61.31T1838.89,1822.86Zm-75.41-20.17q6.76,12,25.33,12t25.32-12q6.76-12,6.77-40.35t-6.88-41.13q-6.87-12.84-25.21-12.84t-25.22,12.84q-6.88,12.82-6.87,41.13T1763.48,1802.69Zm181.87-19.14V1756h45.39V1837q-32.77,5.28-53.17,5.27-36.45,0-50.09-19.48t-13.63-61.88q0-42.4,14.2-61.2t48.37-18.8a241.41,241.41,0,0,1,46.07,4.82l8.25,1.59-.91,24.54q-27.51-3-45-3t-24.64,4.13q-7.1,4.13-10.43,15.25t-3.32,38q0,26.94,6.65,37.71t27.5,10.77l19-.91v-30.26Zm75.19,55.93V1683.61h31.64v155.87Zm759.46-93.7v96.44H2404.74v-96.44h62l-114.66-108.35a130.63,130.63,0,0,0,107-95l215,203.32Zm-361.65-237.12a85,85,0,1,1-85-85A85,85,0,0,1,2418.35,1508.66Zm-51,0a33.91,33.91,0,1,0-33.91,33.9A33.91,33.91,0,0,0,2367.3,1508.66Zm307.62-297a16.32,16.32,0,0,0-5.48-.85,17.66,17.66,0,0,0-17,12.53l-25.9,70.65a20.43,20.43,0,0,1-9.58,12.11l-36.12,21.17-65.07-65.07,18.74-32.22a21.35,21.35,0,0,1,12.22-9.59l70.54-25.9a17.71,17.71,0,0,0,12.64-16.84,16.57,16.57,0,0,0-.84-5.48,17.75,17.75,0,0,0-21.91-11.48l-83.81,29.91a21.35,21.35,0,0,0-12.21,9.58L2490,1236.37l-11.26-11.27-34.65,34.64,15.8,15.8-99.82,105.61a130.65,130.65,0,0,1,99.19,94.55l3.89,3.79,97.51-103.08,23.16,23.16,34.75-34.74-11.9-11.9,40.11-23.48a20.41,20.41,0,0,0,9.59-12.11l29.9-83.81A17.59,17.59,0,0,0,2674.92,1211.63Z\" transform=\"translate(-219.62 -1159.92)\"/></svg></a>
          <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
             <span class='navbar-toggler-icon'></span>
          </button>
          <div class='collapse navbar-collapse' id='navbarSupportedContent'>
            <ul class='navbar-nav mr-auto'>
              	<li class='nav-item'><a class='nav-link' href='../index.php'>Home</a></li>
						<li class='nav-item'><a class='nav-link' href=''>Contact</a></li>
						<li class='nav-item'><a class='nav-link' href='../login.php'>Log på</a></li>
						<li class='nav-item'><a class='nav-link' href='../register.php'>Register</a></li>
						<li class='nav-item'><a class='nav-link' href='https://www.sde.dk/kontakt/kontakt/?'>contact information</a></li>
              </ul>
          </div>
      </nav>
      ";
}
?>
