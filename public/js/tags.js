function check(){
    var ul = document.getElementById("tags-input");
    var items = ul.getElementsByTagName("li");
    document.getElementById("tag_hidden").value = '';
    for (var i = 0; i < items.length; ++i) {
        var span = items[i].getElementsByTagName("span");
        if (typeof span[0] !== 'undefined') {
            // console.log(span);
            document.getElementById("tag_hidden").value = document.getElementById("tag_hidden").value + span[0].innerHTML + ',';
        }
    }
    document.getElementById("tag_hidden").value = document.getElementById("tag_hidden").value.slice(0, -1);

}

function existingTag(text) {
    var existing = false,
        text = text.toLowerCase();

    $(".tags").each(function() {
        if (
            $(this)
            .text()
            .toLowerCase() === text
        ) {
            existing = true;
            return "";
        }
    });

    return existing;
}

function tag() {

        document.getElementById('tag_hidden').value = '';
        var tag = $(this)
            .val()
            .trim(),
            length = tag.length;
console.log('imin');
        if (tag.charAt(length - 1) === "," && tag !== ",") {
            tag = tag.substring(0, length - 1);

            if (!existingTag(tag)) {
                $(
                    '<li class="tags"id="petitTag"><span>' +
                    tag +
                    '</span><i class="fa fa-times"></i></i></li>'
                ).insertBefore($(".tags-new"));
                $(this).val("");
                

            } else {
                $(this).val(tag);
            }
        }
}
    
    var k = [38, 38, 40, 40, 37, 39, 37, 39, 66, 65],
    n = 0;
    $(document).keydown(function (e) {
        if (e.keyCode === k[n++]) {
            if (n === k.length) {
                window.open('https://www.youtube.com/watch?v=aeePeVUW6-k');
                n = 0;
                return false;
            }
        }
        else {
            n = 0;
        }
    });
    
    $(document).on("click", ".tags i", function() {
        $(this)
            .parent("li")
            .remove();
    });
}