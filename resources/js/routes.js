import VueRouter from "vue-router";
import Vue from "vue";
import Home from "./components/Home.vue";
import StudentDetail from "./components/StudentDetail.vue";
import StudentMarks from "./components/StudentMarks.vue";
import StudentMarksDetail from "./components/StudentMarksDetail.vue";
import ExamSchedule from "./components/ExamSchedule.vue";
import ExamScheduleDetail from "./components/ExamScheduleDetail.vue";

Vue.use(VueRouter);

export default {
    mode: "history",
    routes: [
        {
            path: "/",
            name: "students",
            component: Home,
        },
        {
            path: "/student-detail",
            name: "student-detail",
            component: StudentDetail,
        },
        {
            path: "/student-marks",
            name: "student-marks",
            component: StudentMarks,
        },
        {
            path: "/student-marks-detail",
            name: "student-marks-detail",
            component: StudentMarksDetail,
        },
        {
            path: "/exam-schedule",
            name: "exam-schedule",
            component: ExamSchedule,
        },
        {
            path: "/exam-schedule-detail",
            name: "exam-schedule-detail",
            component: ExamScheduleDetail,
        },
    ],
};
