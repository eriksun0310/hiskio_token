<div class="modal fade" id="notifications" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">通知</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <ul>
                @foreach ($notifications as $notification)
                    <li class="read_notification" data-id="{{ $notification->id}}">
                        {{ $notification->data['msg'] }}
                        <span class="read">
                            @if ($notification->read_at)
                                (已讀)
                            @endif
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>
      </div>
    </div>
  </div>
  <script>
    $('.read_notification').on('click', function(){
        var $this = $(this) // = li
        $.ajax({
            type: 'POST',
            url: 'read-notification',
            data: {id: $this.data('id') },
            success: function(msg){
                if(msg.result){
                    $this.find('.read').text('(已讀)')
                }
            }
        })
    })
  </script>