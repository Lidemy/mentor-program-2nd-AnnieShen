## 什麼是 DNS？Google 有提供的公開的 DNS，對 Google 的好處以及對一般大眾的好處是什麼？
- DNS 全名是 Domain Name System 主要網域名稱系統，可以把網域名稱翻譯成 IP 位址。
- Google 的好處：可以知道使用者去了那些網站或是有多少人瀏覽。
- 一般大眾的好處：解析網址時不需要轉太多層，直接查詢 Google 的 DNS 伺服器，然後Google DNS 伺服器再向上查詢一層即可查到正確的IP位置，減少了以往使用國內的 DNS 解析需要轉換多層的問題。另一個優點是會比一般 DNS 伺服器把關更嚴格，讓惡意的 DNS 亂搞行為可以被避免，讓你正確的網址可以連到正確的網站。
參考資料：Google Public DNS 讓上網更安全！https://sofree.cc/google-public-dns/


## 什麼是資料庫的 lock？為什麼我們需要 lock？
- 有用 transition 才要 lock，例如搶票頁面剩一張票，兩個人同時抵達 query 就會發生超賣問題，所以把正在執行的資料鎖住，不讓其他 query 執行，其他 query 會等第一個執行完才解鎖(繼續執行)。

## NoSQL 跟 SQL 的差別在哪裡？
- SQL 是拿來查詢資料庫的語言，SQL 的特性是必須事先定義好 Schema(像是資料庫的規格書)，會先把每一個欄位的名稱跟型態都先固定住，當要建立資料表、欄位、資料型態都要用資料庫指令去新建。
- NoSQL 沒有 Schema，是用 key-value 來存，可以想像成存 json 資料到資料庫，NoSQL 不支援 join 資料表，通常用來存一些不固定的資料。


## 資料庫的 ACID 是什麼？
- 是為了保證 transition 正確性。
1. 原子性 (atomicity)：全部失敗或全部成功
2. 一致性 (consistency)：維持資料的一致性 (例如:錢的總數要相同)
3. 隔離性 (isolation)：多筆交易不會互相影響，也就是不能同時改一個值
4. 持久性 (durability)：交易成功後，寫入的資料不會消失