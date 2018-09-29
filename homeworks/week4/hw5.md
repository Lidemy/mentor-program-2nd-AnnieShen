## hw5：簡答題

#### 1. 什麼是 DOM？
* DOM 的全名是 Document Object Model (文件物件模型)，提供给 Javascript 用來動態修改文件，讓你可以更動其中的內容，使用 Javascript 語言，然後告訴 Javascript 要改變哪一個 node。

#### 2. 什麼是 Ajax？
* Ajax 的全名是 Asynchronous Javascript and XML，Asynchronous 是非同步的意思，就是說我們要取資料的時候，我們不用等資料拿到再去執行下一步，而是可以同時做其他事情，等 Response 回來會自動把結果送過來。

#### 3. HTTP method 有哪幾個？有什麼不一樣？
常見的 http Method 有六種，分別是 head, get, post, delete, put, patch，不同的 Method 就是對同一件事情做不同的操作。
* head - 和 get 一樣，只是 head 只會取的 http header 的資料。
* get - 取得我們想要的資料。
* post - 新增資料，如果原本已有資料，再額外新增一項資料。
* delete - 刪除資料。
* put - 如果原本已有資料，新增的資料會蓋掉舊的。
* patch - 擴充資料，附加新的資料在原本的資料後面，前提是必須有已存在的資料。

#### 4. `GET` 跟 `POST` 有哪些區別，可以試著舉幾個例子嗎？
在 http 中，有兩種方法可以將資料送到 Web Server 端，分別是 GET 和 POST。
* GET - 當使用 GET 時，會將表單資訊附加在 URL 上並作為 QueryString 的一部分，使用 GET 方法將資料送到Web Server時，可以透過瀏覽器的網址看到完整的URL和 QueryString，所以這是一種不安全的方法，傳輸資料大小也會受 QueryString 長度限制。
* POST - 將要傳送的資訊放隱藏在 message-body 中，可以防止使用者操作瀏覽器網址，因為要將表單的資料送回 Web Server，速度較 GET 慢，但安全性較高，也可大量傳輸資料。

#### 5. 什麼是 RESTful API？
* REST 的全名是 Representational State Transfer，Restful API 就是被轉化成 Rest 架構的 Web API，RESTful 可以想成是一種建立在 http 協定之上的設計模式，充分利用 http method 來表示對資源的各種行為，這樣做的好處就是資源和操作分離，讓對資源的管理有更好的規範與閱讀。 

#### 6. JSON 是什麼？
* JSON 是一種數據交換格式。在查資料時候看到一個比較白話的比喻，他說 JSON 是組織用來書寫和交換情報的“暗號”，而 JSONP 則是把用暗號書寫的情報傳遞給組織成員使用的接洽方式。

#### 7. JSONP 是什麼？
* JSON with padding，原理 script 標籤可以跨網域，是一種雙方約定傳遞訊息的方法，為了便於客戶端使用數據而產生，該協議的一個要點就是允許用戶傳遞一個 callback 參數給 server 端，然後server 端返回數據時會將這個 callback 參數作為函數名來包裹住 JSON 數據，這樣客戶端就可以隨意定制自己的函數來自動處理返回數據。

#### 8. 要如何存取跨網域的 API？
* 用 CORS，全名為 Cross-Origin Resource Sharing，跨來源資源共享，Server 必須在 Response 的 Header 裡面加上 Access-Control-Allow-Origin: *，星號就代表萬用字元，意思是任何一個 Origin 都接受，即可以存取跨網域的 API。
