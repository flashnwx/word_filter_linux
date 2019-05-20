<table >
    <thead>
    <tr>
        <th>序号</th>
        <th>标题</th>
        <th>内容</th>
        <th>状态</th>
        <th>时间</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($data as $k => $v) {
        ?>
        <tr>
            <td><?php echo $v['id'];?> </td>
            <td><?php echo $v['title'] ?></td>
            <td><?php echo $v['content'] ?></td>
            <td><?php switch($v['status']){
                    case 1: echo  '已发布'; break;
                    case 2: echo '草稿';  break;
                    case 3: echo '含敏感词';  break;
                }

                ?></td>
            <td><?php echo $v['ctime']; ?></td>

        </tr>
        <?php
    }
    ?>
    </tbody>
</table>