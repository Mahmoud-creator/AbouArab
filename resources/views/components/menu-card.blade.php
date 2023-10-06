@props(["image" => "", "white-image" => "", "name" => ""])
<div class="swiper-slide menu-slide transition-all p-5 text-center cursor-pointer hover:bg-red-400 hover:text-white">
    <input type="hidden" value="{{ $whiteImage }}" class="whiteImage">
    <input type="hidden" value="{{ $image }}" class="image">
    <div class="flex flex-col gap-4">
        <div>
            <img class="menu-icon mx-auto" src="{{ $image }}"
                 alt="burger">
        </div>
        <div>
            <p>{{ $name }}</p>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.swiper-slide').hover(function () {
            let whiteImage = $(this).find('.whiteImage').val()
            console.log('whiteimage' + whiteImage)
            $(this).find('.menu-icon').attr('src', whiteImage)
        }, function () {
            let image = $(this).find('.image').val()
            console.log('image' + image)
            $(this).find('.menu-icon').attr('src', image)
        })
    })
</script>
