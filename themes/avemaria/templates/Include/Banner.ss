<div class="banner">
    <div id="banner-slider" class="banner-slider">
        <% if $Slider %>
        <% loop $Slider %>
        <div class="slide overlay-dark fullscreen" style="background: url($Image.CroppedImage(1120,300).url); background-size: cover;">
        </div>
        <% end_loop %>
        <% end_if %>
        <div class="slide overlay-dark fullscreen" style="background: url($ThemeDir/images/banner/img-01.jpg); background-size: cover;">
        </div>
        <div class="slide overlay-dark fullscreen" style="background: url($ThemeDir/images/banner/img-02.jpg); background-size: cover;">
        </div>


    </div>
</div>
