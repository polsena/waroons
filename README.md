# waroons
<h4>แจกฟรี ระบบบริหารจัดการข่าวออนไลน์สุดล้ำ พัฒนาจาก Codeigniter Framework</h4>
<h4>ระบบพัฒนาจาก Codeigniter Framework ต้องใช้ PHP v. 5.6 นะครับ</h4>

<b>คุณสมบัติ<b/>
  <hr/>
  <ul>
    <li>มีหน้า frontend สำหรับแสดงเนื้อหาข่าวและรายละเอียดของข่าว</li>
     <li>มีระบบ backoffice สุดอลังการ</li>
     <li>มีระบบจัดการสมาชิก จัดการสิทธิ์การเข้าถึง</li>
     <li>มีระบบจัดการประเภทข่าว</li>
     <li>มีระบบประกาศข่าว</li> 
    <li>มีระบบแสดงสถิติข่าวแต่ละประเภท</li>
     <li>สามารถแปะ iframe ได้ เมื่อต้องการนำข่าวแต่ละประเภทไปแสดงบนเว็บไซต์อื่น</li>
     <li>มีระบบแสดงคนเข้าชมเว็บไซต์</li>
     <li>มีระบบแสดงจำนวนคนอ่านข่าว</li>
     <li>มีระบบค้นหาข่าว</li>
     <li>แสดงสถิติผู้ประกาศข่าว</li>
  </ul>



<h4>backoffice</h4>
http://localhost/waroons/login

User : theadmin404 <br/>
Pass : theadmin404

<img src = "https://miro.medium.com/max/1349/1*UL6-a6rcHv-qRlIoWOE_aw.png"></img>
<br/>
<h4>หน้า BackOffice </h4>
<img src = "https://miro.medium.com/max/1322/1*vl0x31T5jrfSKV2ZAc5yog.png"></img>


<hr/>
<h4>การติดตั้ง</h4>
<hr/>
<p>1.ให้โหลดไฟล์ตามลิงค์ https://github.com/leksoft/waroons แล้วแตกไฟล์ออกแล้ว copy ไฟล์ไปไว้ใน htdocs ในนี้ผมใช้ MAMP จำลอง server นะครับ
</p>
<img src = "https://miro.medium.com/max/733/1*InNrKuHJYpLp6MwRFyXL7w.png"></img>
<p>2.นำเข้าฐานข้อมูล ชื่อ waroonsDB.sql</p>
<img src = "https://miro.medium.com/max/887/1*dG9qukGz4YYgEvEEivALXw.png"></img>
<p>หรือถ้าใช้ phpmyadmin ก็ให้สร้างฐานข้อมูลขึ้นมาก่อนแล้วก็ import เข้าปกติเลยครับ</p>
<img src = "https://miro.medium.com/max/697/1*jmVfv27PlHbf_EUsCOcwMw.png"></img>
<p>3.ตั้งค่าการเชื่อมต่อฐานข้อมูล ให้เข้าไปในไฟล์ application/config/database.php แล้วกำหนดรายละเอียดการเชื่อมต่อฐานข้อมูลของท่านเลยครับ</p>
<img src = "https://miro.medium.com/max/1022/1*FImBq54_nifhpTP7_hCtbA.png"></img>
<p>4.ตั้งค่า ไฟล์ .htaccess ตามรูป</p>
<img src = "https://miro.medium.com/max/854/1*K4mvNDILsIuXPM09mS0XvQ.png"></img>
<p>ไฟล์ .htaccess จะอยู่ตรงนี้นะครับ</p>
<img src = "https://miro.medium.com/max/558/1*Ptz2LaoPWvgG3agh2bcU_w.png"></img>
<p>5.ในไฟล์ config.php ให้แก้ตามนี้ application/config/config.php</p>
<img src = "https://miro.medium.com/max/1023/1*BxOWcGWH7uyeMaknO0nJCA.png"></img>
<p>เสร็จแล้วก็ให้รันดูครับ พิมพ์ http://localhost/waroons/ บน chrome</p>
<img src = "https://miro.medium.com/max/1258/1*7lAHChrqism_E27GYzrnbg.png"></img>

แปะ iframe 
<code>
  <iframe src="http://localhost/waroons/home/hotnewsv2" height="200" width="300"></iframe>
</code>

<hr/>
มีปัญหาการติดตั้งปรึกษาผมได้ผ่าน https://www.facebook.com/m.nakharin ได้เลยครับ
<hr/>
หากสนใจเรียน codeginter framework สามารถเรียนได้ผ่านช่อง Youtube ผมได้ตลอด เลยนะครับ<br/>
https://www.youtube.com/user/leksoft
