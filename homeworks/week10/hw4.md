## gulp 跟 webpack 有什麼不一樣？我們可以不用它們嗎？
- gulp 是把任務自動化，可以做壓縮圖片、移動檔案、compile css、轉換 js、minify 
- webpack 是用打包資源，可以用 import 把資源(包括圖片、CSS)加載進來，也可以做到 compile css、轉換 js ...等
可以不使用，但是使用了會比較省時也好維護，也可以減少檔案大小。

## hw3 把 todo list 這樣改寫，可能會有什麼問題？
每一次更新或刪除都要重新渲染，會降低效能。

## CSS Sprites 與 Data URI 的優缺點是什麼？
- CSS Sprites 是將整個網頁會用到的圖片，組合成 1 張大圖片，再透過 CSS 的 background-position 去定位圖片位置，如此一來載入頁面時僅需發出一次請求，優點是提高效能，缺點則是需要花更多時間去把小圖像全部結合在一張。
- Data URI 是將圖片轉換成 base64 編碼後儲存在 url，優點是能夠減少 HTTP 請求，提高性能，缺點是瀏覽器沒辦法將它快取起來，編碼後易讀性差，當檔案資料有變化時，所有內嵌它的網頁都要重新產生編碼。
