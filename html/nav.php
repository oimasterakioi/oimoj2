<div class="ui borderless menu top fixed">
    <div class="ui container">
        <a class="item" href="/">
            <div style="font-size: 20px; display: inline-block;">
                <?php echo changeToVue("˚∆˚OJ"); ?>
            </div>
        </a>
        <a class="item" href="/problems.php">
            <?php echoIcon('book'); ?>
            <?php echo changeToVue("题库"); ?>
        </a>
        <a class="item" href="/contests.php">
            <?php echoIcon('calendar'); ?>
            <?php echo changeToVue("比赛"); ?>
        </a>
        <a class="item" href="/submissions.php">
            <?php echoIcon('code'); ?>
            <?php echo changeToVue("评测"); ?>
        </a>
        <a class="item" href="/blogs.php">
            <?php echoIcon('newspaper'); ?>
            <?php echo changeToVue("讨论"); ?>
        </a>

        <?php if (isset($currentUser)): ?>
        <div class="ui item simple dropdown" style="margin-left: auto;">
            <div class="devider text"><?php echo changeToVue($currentUser); ?></div>
            <?php echoIcon('dropdown'); ?>
            <div class="menu transition">
                <a class="item" href="/user.php?username=<?php echo $currentUser; ?>">
                    <?php echoIcon('user'); ?>
                    <?php echo changeToVue("主页"); ?>
                </a>
                <?php if(isAdmin($currentUser)): ?>
                <a class="item" href="/admin.php">
                    <?php echoIcon('cogs'); ?>
                    <?php echo changeToVue("管理"); ?>
                </a>
                <?php endif; ?>
                <a class="item" href="/logout.php">
                    <?php echoIcon('sign-out'); ?>
                    <?php echo changeToVue("登出"); ?>
                </a>
            </div>
        </div>
        <?php else: ?>
        <div class="item" style="margin-left: auto;">
            <a class="ui button" style="margin-right: 0.4em;" href="/login.php">
                <!-- <?php echoIcon('sign-in'); ?> -->
                <?php echo changeToVue("登录"); ?>
            </a>
            <a class="ui primary button" href="/register.php">
                <!-- <?php echoIcon('angle right'); ?> -->
                <?php echo changeToVue("注册"); ?>
            </a>
        </div>
        <?php endif; ?>
    </div>
</div>
<div class="ui container" style="padding-top: 60px;">
