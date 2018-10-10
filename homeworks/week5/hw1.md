資料庫名稱：users

| 欄位名稱 | 欄位型態 | 說明 |
|----------|----------|------|
|  id  |    integer      | 使用者 id     |
| user_id   | varchar | 使用者帳號  |
| nickname   | varchar | 使用者暱稱  |
| password   | varchar | 使用者密碼  |
<br/>

資料庫名稱：comments

| 欄位名稱 | 欄位型態 | 說明 |
|----------|----------|------|
|  id  |    integer      | 留言 id     |
| content   | text | 留言內容  |
|  user_id  |    varchar      | 留言者的帳號     |
|  created_at  |    timestamp      | 留言時間     |
<br/>

資料庫名稱：commentschild

| 欄位名稱 | 欄位型態 | 說明 |
|----------|----------|------|
|  id  |    integer      | 子留言 id     |
| parent_id   | varchar | 父留言 id  |
|  user_id  |    varchar      | 子留言者的帳號     |
| content   | text | 子留言內容  |
|  created_at  |     timestamp      | 子留言時間     |
