# 建議事項

1. 目錄下的主要檔案或第一個要執行的檔案儘量以index.php或index.html來命名
2. 儘量使用相對路徑來取代絕對路徑
```
  <a class="show" href="calendar.php?month=......
    改成
  <a class="show" href="?month=.....
```
3. 253及259行的`arrow.png`圖片不存在，建議補上圖片。
4. 255及261行計算月份的公式會出現0月及13月的狀況，建議使用原先已計算好的變數$premonth及$nextmonth
5. 第9行連結的外部css檔不存在，建議補上animate.css
6. 第47行連結的背景檔'bg.jpg'，建議補上檔案