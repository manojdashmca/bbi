<script type="text/javascript">
    $(document).ready(function () {
<?php if (!empty($ibo)) { ?>
            generateTree('<?= $ibo ?>');
<?php } ?>
    });


    function generateTree(usercode) {
        resetAllNodes();
        $.ajax({
            type: "post",
            url: '<?= ADMINPATH ?>tree-treeview-data',
            data: {usercode: usercode},
            datatype: "html",
            success: function (data)
            {
                var nobj = JSON.parse(data);
                if (nobj.status == 'Ok') {
                    var nodedata = nobj.data;
                    var arr = $.map(nodedata, function (el) {
                        return el
                    });

                    console.log(arr);
                    for (var x = 0; x < arr.length; x++) {
                        if (arr[x].Id != 0)
                            setNodeValue(arr[x], x + 1);
                    }
                } else {
                    resetAllNodes();
                }
            }
        });
    }

    function setNodeValue(data, node) {
        if (data.Ps == 1) {
            $("#node" + node).html('<span class="text-success"><i class="fa fa-user-circle"></i></span>');
        } else {
            $("#node" + node).html('<span class="text-danger"><i class="fa fa-user-circle"></i></span>');
        }
        //var value = '<a href="javascript:void(0)" onmouseover="tooltip.pop(this, &#39;#tip' + node + '&#39;,{sticky:false, position:0, cssClass:&#39;no-padding&#39;})" onclick="">' + data.Name + '(' + data.Id + ')' + '</a>';
        var value = '<a href="<?= ADMINPATH ?>binary-tree?jsession=<?= createEpin(32) ?>&trnid=<?= $transactionid ?>&usercode=' + data.Code + '" data-tooltip="tip' + node + '">' + data.Name + '(' + data.Code + ')' + '</a>';
        $("#node" + node + "name").html(value);
        var nodedata = '<table width="250" cellspaacing="10" cellpadding="10">';
        nodedata += '<tr><th>Name: </th><td>' + data.Name + '</td></tr>';
        nodedata += '<tr><th>Id: </th><td>' + data.Id + '</td></tr>';
        nodedata += '<tr><th>Code: </th><td>' + data.Code + '</td></tr>';
        nodedata += '<tr><th>DOJ: </th><td>' + data.DOJ + '</td></tr>';
        nodedata += '<tr><td><table><tr><th colspan="2">Left</th></tr>';
        nodedata += '<tr><th>Total Ids-</th><td>' + data.Left + '</td></tr>';
        nodedata += '<tr><th>FOB INR-</th><td>' + data.Left_FOI + '</td></tr>';
        nodedata += '<tr><th>GCC-</th><td>' + data.Left_T_BV + '</td></tr></table></td>';
        nodedata += '<td><table><tr><th colspan="2">Right</th></tr>';
        nodedata += '<tr><th>Total Ids-</th><td>' + data.Right + '</td></tr>';
        nodedata += '<tr><th>FOB INR-</th><td>' + data.Right_FOI + '</td></tr>';
        nodedata += '<tr><th>GCC-</th><td>' + data.Right_T_BV + '</td></tr></table></td></tr>';
        nodedata += '</table>';
        $("#tip" + node).html(nodedata);
    }

    function resetAllNodes() {
        for (var x = 1; x < 16; x++) {
            $("#node" + x).html('<span class="text-gray"><i class="fa fa-user-circle"></i></span>');
            $("#node" + x + "name").html('');
        }
    }

    function changeCssTree() {

        var targets = $('[rel~=tooltip]'),
                target = false,
                tooltip = false,
                title = false;

        targets.bind('mouseenter', function ()
        {
            target = $(this);
            tip = target.attr('title');
            tooltip = $('<div id="tooltip"></div>');

            if (!tip || tip == '')
                return false;

            target.removeAttr('title');
            tooltip.css('opacity', 0)
                    .html(tip)
                    .appendTo('body');

            var init_tooltip = function ()
            {
                if ($(window).width() < tooltip.outerWidth() * 1.5)
                    tooltip.css('max-width', $(window).width() / 2);
                else
                    tooltip.css('max-width', 340);

                var pos_left = target.offset().left + (target.outerWidth() / 2) - (tooltip.outerWidth() / 2),
                        pos_top = target.offset().top - tooltip.outerHeight() - 20;

                if (pos_left < 0)
                {
                    pos_left = target.offset().left + target.outerWidth() / 2 - 20;
                    tooltip.addClass('left');
                } else
                    tooltip.removeClass('left');

                if (pos_left + tooltip.outerWidth() > $(window).width())
                {
                    pos_left = target.offset().left - tooltip.outerWidth() + target.outerWidth() / 2 + 20;
                    tooltip.addClass('right');
                } else
                    tooltip.removeClass('right');

                if (pos_top < 0)
                {
                    var pos_top = target.offset().top + target.outerHeight();
                    tooltip.addClass('top');
                } else
                    tooltip.removeClass('top');

                tooltip.css({left: pos_left, top: pos_top})
                        .animate({top: '+=10', opacity: 1}, 50);
            };

            init_tooltip();
            $(window).resize(init_tooltip);

            var remove_tooltip = function ()
            {
                tooltip.animate({top: '-=10', opacity: 0}, 50, function ()
                {
                    $(this).remove();
                });

                target.attr('title', tip);
            };

            target.bind('mouseleave', remove_tooltip);
            tooltip.bind('click', remove_tooltip);
        });

    }
</script>