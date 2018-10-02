## 請找出三個課程裡面沒提到的 HTML 標籤並一一說明作用。
1. <dl> 標籤，搭配 <dt> <dd> 一起使用，類似 <ul><li>，<dl>用來包起整個清單，<dt>是項目，<dd>可以當描述 
     <dl>
　	   <dt>項目一</dt>
	 　<dd>內容內容內容 ...</dd>
       <dt>項目二</dt>
　	   <dd>內容內容內容 ...</dd>
	 </dl>
2. <i>文字內容 ...</i> 可以讓文字變斜體
3. <button> 是按鈕標籤，在 html 裡要做表單的送出，除了可以用 <input type="button"> 也可以用 <button> 


## 請問什麼是盒模型（box modal）
盒模型就是內容本身往外依序為 padding、border、margin，可以使用 css 來定義 box-sizing，如果是 content-box，元素本身的寬高不會包含 padding、border；
若是 border-box，元素的 padding、border，會包含在原本設定元素的寬高內。


## 請問 display: inline, block 跟 inline-block 的差別是什麼？
- display:inline，所有被設定為inline的樣式皆會在同一行，不斷行。
- display:block，表示區塊，像 div 本身的樣式就是 block。
- display:inline-block，擁有區塊的屬性，卻又可以排在同一行，如果要將 div 並排時候就會用到 inline-block。


## 請問 position: static, relative, absolute 跟 fixed 的差別是什麼？
- static 是預設值，會按照原本位置去排版。
- relative 可以用 top、left、bottom、right 來改變定位，若沒有設定則會是預設值，也可以用 z-index 來改變他的上下圖層。
- absolute 可以根據上層來定位相對位置，只要上層不是 static 的元素定位即可。
- fixed 會根據視窗來定位，當頁面捲軸往下滾也不會改變他的位置。 