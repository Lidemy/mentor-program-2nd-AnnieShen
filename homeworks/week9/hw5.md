## CSS 預處理器是什麼？我們可以不用它嗎？
- CSS 預處理器就是用程式化的方式編寫 CSS，最後在編譯成網頁可讀的 CSS。
- 目前有三種 SCSS/SASS、LESS、Stylus，目前最普遍使用的是 SASS，基本上三種的寫法差不多。
- 有 CSS 預處理器可以讓 CSS 更有系統的管理與修正，可以不用(因為在今天以前我都沒用...XD)，但是用了之後會比較好維護，可讀性也會比較高，這是我目前感受到的好處。

## 請舉出任何一個跟 HTTP Cache 有關的 Header 並說明其作用。
- Cache-Control，用法：
`Cache-Control: max-age=30`
代表這個 Response 的過期時間是 30 秒，所以當使用者在收到這個 Response 之後的 30 秒內重新整理，資料就會被瀏覽器 Cache 住，如果超過 30 秒後重新整理，瀏覽器就會發送新的 Request。

## Stack 跟 Queue 的差別是什麼？
- Stack (中文:堆疊 / 大陸:棧)，push 的會放在最上面，也會從最上面先 pop 出來，也就是 First In, Last Out。
- Queue (中文:佇列 / 大陸:隊列)，就像排隊一樣照順序，push 的會放在最前面，會從最前面開始 shift，也就是 First In, First Out。

## 請去查詢資料並解釋 CSS Selector 的權重是如何計算的（不要複製貼上，請自己思考過一遍再自己寫出來）
| 項目  | 分數  | 範例 |
| :------------ |:---------------:|:---------------:|
| *           | 0-0-0-0 | 全部 | 
| Element     | 0-0-0-1 | 例 div / p / body |
| class       | 0-0-1-0 | 例 div class = "abc" |
| psuedo-class| 0-0-1-0 | 例 :nth-child / :hover / :after |
| attribute   | 0-0-1-0 | 例 input[name = abc] |
| id          | 0-1-0-0 | 例 div id = "abc" |
| inline style| 1-0-0-0 | 例 div style = "background-color:#eee;" |
| !important  | 1-0-0-0-0 | 可以蓋過所有的權重 |

1. 計算方式是用累加的，例如：
- div.abc，計算方式是 [0-0-0-1] + [0-0-1-0] = 0-0-1-1
- div.abc > input[name="reply"]，計算方式是 [0-0-0-1] + [0-0-1-0] + [0-0-1-0] = 0-0-2-1
- #row > .nickname > input，計算方式是 [0-1-0-0] + [0-0-1-0] + [0-0-0-1] = 0-1-1-1

2. 層級寫的越詳細，權重分數越高，例如：
- div.container 的分數 > .container 的分數
