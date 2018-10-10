## 資料庫欄位型態 VARCHAR 跟 TEXT 的差別是什麼
- varchar 可以固定長度，例如 varchar(16) 這樣的填寫方式，最大長度為65535，可以設定預設值。
- text 可儲存最大長度為 2^31-1 個字符，text 不能設定預設值，後面()如果指定長度不會出錯，但是這個長度沒有用，就算存的資料超過指定的長度還是可以正常儲存，所以 text 長度是不固定的。

  

## Cookie 是什麼？在 HTTP 這一層要怎麼設定 Cookie，瀏覽器又會以什麼形式帶去 Server？
- Cookie 是讓瀏覽器來儲存我們有輸入過的內容，然後會將網站所需使的資訊存在 client 端的瀏覽器上。
1. Client 端向 Web Server 要求某個網頁，同時也會將符合的 Cookie 資訊傳送到 Server 端。
2. 當 Server 端回傳網頁給 Client 端，Server 端會回傳一或多個 Set-Cookie 的 HTTP Response 給瀏覽器，瀏覽器會將回傳回來的 Cookie 資料記錄到電腦的資料夾中，並且記錄該 Cookie 的隸屬網域(Domain)、存放目錄(Path)、過期時間(Expires) 等資訊。
3. 之後當 Client 端要求某一個網頁時，瀏覽器會檢查它儲存了的 Cookie 是否允許被那一個網頁存取，如果是允許的話，就會在 HTTP Request Header 加入 Cookie 一欄， 一同傳送到伺服器。
參考資料 : [http://taiwantc.com/js/js_tut_c_cookie0.htm#Cookie%20%E5%A6%82%E4%BD%95%E9%81%8B%E4%BD%9C](http://taiwantc.com/js/js_tut_c_cookie0.htm#Cookie%20%E5%A6%82%E4%BD%95%E9%81%8B%E4%BD%9C)


## 我們本週實作的會員系統，你能夠想到什麼潛在的問題嗎？
- cookie若沒清掉，只要有一樣名稱的 cookie 就可以登入我的系統。