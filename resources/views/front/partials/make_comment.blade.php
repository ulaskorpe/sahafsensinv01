<div class="row mb-0">
    <div class="col-12  d-flex justify-content-end">
        <p>Ürün yorumlarına dönmek  için</p>
    </div>
    <div class="col-12 d-flex justify-content-end">
        <input type="button" value="Tıklayın" onclick="show_comments('{{$product_id}}',0)"  class="btn btn-primary px-3">
    </div>
</div>

<div class="row">
    <h4 class="mb-4">Yorum yazın</h4>
    <div class="col-md-12">
    <p>Bu ürün hakkında bildiklerinizi ve görüşlerinizi diğer kullanıcılar ile paylaşabilirsiniz</p>
    </div>
    @if($comment)

        <div class="col-md-12  bg-secondary">

            <div class="media mb-4">

                <div class="media-body">
                    <h6  class="mt-3">{{$comment->user()->first()->name}}<small> - <i>{{\Carbon\Carbon::parse($comment['created_at'])->format('d.m.Y H:i')}}</i></small></h6>

                    <p class="mt-3">{{$comment['comment']}} </p>

                </div>
            </div>
        </div>

    @endif
    <div class="col-md-6">
    <form class="form" id="comment-form" name="comment-form" action="#"
    method="post" enctype="multipart/form-data">
    <input type="hidden" name="product_id" value="{{$product['id']}}">
    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
        <div class="form-group mt-5">
            @if($comment)
            <label for="message">Yanıtınız</label>
            @else
            <label for="message">Yorumunuz</label>
            @endif
            <textarea id="comment" name="comment" cols="30" rows="5" class="form-control"></textarea>
        </div>

        <div class="form-group mb-0">
            @if($comment)
            <input type="submit" onclick="make_comment_post()" value="Yanıtla" class="btn btn-primary px-3">
            <input type="hidden" name="comment_id" value="{{$comment['id']}}">
            @else
            <input type="hidden" name="comment_id" value="0">
            <input type="submit" onclick="make_comment_post()" value="Gönder" class="btn btn-primary px-3">
            @endif
        </div>
    </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ url('assets/js/saveV3.js') }}"></script>
<script>
 $('#comment-form').submit(function(e) {
    e.preventDefault();
    var error = false;
    if ($('#comment').val().length < 10) {
                $('#comment').focus();
                Swal.fire({
                    icon: 'error',
                    text: 'Lütfen yorum giriniz'
                });
                error = true;
                return false;
             }
    var formData = new FormData(this);
    save(formData,'{{ route('comment_post') }}','comment-form','','/urun-detay/{{$product['slug']}}/{{$product['id']}}');

});
</script>
