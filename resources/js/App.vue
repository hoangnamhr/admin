<template>
    <div class="d-flex" id="student">
        <div class="menu">
            <nav>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a
                            class="nav-link"
                            @click="$router.push({ name: 'students' })"
                            :class="{
                                'nav-active': [
                                    'students',
                                    'student-detail',
                                ].includes($route.name),
                            }"
                            href="#"
                            >Students</a
                        >
                    </li>
                    <li class="nav-item">
                        <a
                            class="nav-link"
                            @click="$router.push({ name: 'student-marks' })"
                            :class="{
                                'nav-active': [
                                    'student-marks',
                                    'student-marks-detail',
                                ].includes($route.name),
                            }"
                            href="#"
                            >Marks</a
                        >
                    </li>
                    <li class="nav-item">
                        <a
                            class="nav-link"
                            @click="$router.push({ name: 'exam-schedule' })"
                            :class="{
                                'nav-active': [
                                    'exam-schedule',
                                ].includes($route.name),
                            }"
                            href="#"
                            >Exam Schedule</a
                        >
                    </li>
                </ul>
            </nav>
        </div>
        <router-view />
    </div>
</template>
<script>
export default {};
</script>

<style scoped lang="scss">
#student {
    .menu {
        position: absolute;
        height: 100%;
        width: 200px;
        text-align: center;
        background-color: rgb(77 82 98 / 68%);
        .nav-link {
            font-size: 16px;
            padding: 20px 10px;
            color: white;
            &.nav-active {
                background-color: rgb(190, 190, 233);
            }
        }
    }
}
</style>
