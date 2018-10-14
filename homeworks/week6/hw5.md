## 請說明 SQL Injection 的攻擊原理以及防範方法
- 原理：SQL Injection 是透過在網頁中的輸入欄位或網址列的參數夾帶惡意的 SQL 語法，進而入侵到資料庫來取得資料(EX: 登入、撈出使用者資料、刪除資料...等等)。
- 防範方法：使用 prepare statement 預處理，將變數設為 ?，再用 bind_param 把變數名稱帶入，範例如下：
`
$stmt = $conn->prepare("INSERT INTO MyGuests (firstname, lastname, email) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $firstname, $lastname, $email);
`
## 請說明 XSS 的攻擊原理以及防範方法
- 全名為 Cross-site scripting (跨網站指令碼)，是透過注入程式碼到網頁，使 user 載入網頁時會執行惡意的網頁程式(竄改頁面、連結、盜用 cookie...等等)，這些惡意程式碼可能是 JavaScript、HTML 或其他程式語言，防範方法是用過濾特殊字元來解決 XSS 的攻擊，只須用在輸出在畫面的時候，存進資料庫時候不用 escape。
`<? echo htmlspecialchars($str, ENT_QUOTES,’utf-8’); ?>`


## 請說明 CSRF 的攻擊原理以及防範方法
- 全名為 Cross Site Request Forgery，跨站請求偽造，又稱作 one-click attack，必須在已登入的狀況下才會受到 CSRF 的攻擊，但是因為瀏覽器的機制，只要發送 request 給某個網域，就會把關聯的 cookie 一起帶上去，因此可以在不同的網域偽造使用者本人發出的 request，所以若是使用 get 做為刪除動作，那在別的網頁上點擊像 /delete?id=3 的 url，就能不自覺的刪了某個資料。

- 解決方法：
1.加上圖形驗證碼、簡訊驗證碼。
　
2.加上 CSRF token，確保有些資訊只有使用者知道，操作方法可以在 form 裡面加上一個 hidden 的欄位，叫做 csrftoken，value 由 server 隨機產生，並且存在 server 的 session 中，按下 submit 之後，server 比對表單中的 csrftoken 與自己 session 裡面存的是不是一樣的，是的話就代表是由使用者本人發出的 request。
　
`<form action="https://small-min.blog.com/delete" method="POST">`
`<input type="hidden" name="id" value="3"/>`
`<input type="hidden" name="csrftoken" value="fj1iro2jro12ijoi1"/>`
`<input type="submit" value="刪除文章"/>`
`</form>`
　
3.Double Submit Cookie 和 CSRF token 一樣由 server 產生一組隨機的 token 並且加在 form 上面。但 Double Submit Cookie 不用把這個值寫在 session，同時也讓 client side 設定一個名叫 csrftoken 的 cookie，值也是同一組 token。
`Set-Cookie: csrftoken=fj1iro2jro12ijoi1`
`<form action="https://small-min.blog.com/delete" method="POST">`
`<input type="hidden" name="id" value="3"/>`
`<input type="hidden" name="csrftoken" value="fj1iro2jro12ijoi1"/>`
`<input type="submit" value="刪除文章"/>`
`</form>`
　
- 參考資料：
從防禦認識 CSRF [https://www.ithome.com.tw/voice/115822](https://www.ithome.com.tw/voice/115822)
讓我們來談談 CSRF [https://blog.techbridge.cc/2017/02/25/csrf-introduction/]( https://blog.techbridge.cc/2017/02/25/csrf-introduction/)

## 請舉出三種不同的雜湊函數
- MD5 演算法
- SHA-1 演算法
- Bcrypt


## 請去查什麼是 Session，以及 Session 跟 Cookie 的差別
- Session 存在 Server 端，user 端只會儲存一組 session id，Session 多用來儲存敏感性的資料，並搭配 uniqid()將 session id 設為隨機的代碼，別人便無法知道 user 真正輸入的資料是什麼。
- cookie 存在 Client 端，使用者輸入什麼，cookie 就會存什麼，因此儘量避免使用Cookie儲存敏感的資料。

## `include`、`require`、`include_once`、`require_once` 的差別
- include 檔案在執行時，如果 include 進來的檔案發生錯誤的話，會顯示警告不會立刻停止，一般是放在流程控制的處理部分中，在頁面讀到 include 的檔案時，才將它讀進來。
- require 檔案在執行時，如果 require 進來的檔案發生錯誤的話，則是會顯示錯誤，立刻終止程式，不再往下執行，而且 require 不能用在迴圈或判斷式裡面。
- include_once 和 require_once 是在導入檔案前，會先檢查檔案是否已經在其他地方被導入過了，如果有就不會再重複導入檔案。