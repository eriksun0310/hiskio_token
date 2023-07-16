{{-------------------------- 上傳圖片 的modal ------------------------}}
<div class="modal fade" id="upload_image" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">上傳圖片</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
           <form action="/admin/products/upload-image" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="product_id" name="product_id">
                <input type="file" name="product_image" id="product_image">
                <button type="sumbit">送出</button>
           </form>
        </div>
      </div>
    </div>
</div>


{{-------------------------- 匯入Excel 的modal ------------------------}}

<div class="modal fade" id="import" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">匯入Excel</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <form action="/admin/products/excel/import" method="POST" enctype="multipart/form-data">
              <input type="file" name="excel" id="excel">
              <button type="sumbit">送出</button>
         </form>
      </div>
    </div>
  </div>
</div>

