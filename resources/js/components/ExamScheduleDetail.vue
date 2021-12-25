<template>
    <div class="container student-detail">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Detail</div>

                    <div class="card-body">
                        <div class="form-group">
                            <label for="student_id">Student Id</label>
                            <input
                                type="text"
                                v-model="params.student_id"
                                class="form-control"
                                id="student_id"
                                name="student_id"
                                v-validate="'required'"
                            />
                            <span class="error-message">{{
                                errors.first("student_id")
                            }}</span>
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input
                                type="text"
                                v-model="params.subject"
                                class="form-control"
                                id="subject"
                                name="subject"
                                v-validate="'required'"
                            />
                            <span class="error-message">{{
                                errors.first("subject")
                            }}</span>
                        </div>
                        <div class="form-group">
                            <label for="class">Class</label>
                            <input
                                type="text"
                                v-model="params.class"
                                class="form-control"
                                id="class"
                                name="class"
                                v-validate="'required'"
                            />
                            <span class="error-message">{{
                                errors.first("class")
                            }}</span>
                        </div>
                        <div class="form-group">
                            <label for="date">Semester</label>
                            <input
                                type="datetime-local"
                                v-model="params.date"
                                class="form-control"
                                id="date"
                                name="date"
                            />
                            <span class="error-message">{{
                                errors.first("date")
                            }}</span>
                        </div>
                        <button
                            @click="createOrUpdateStudentMarks()"
                            class="btn btn-primary custom-btn"
                        >
                            {{ isUpdate ? "Update" : "Create" }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            params: {},
            isUpdate: false,
        };
    },
    watch: {
        "$route.params": {
            handler() {
                if (this.$route.params.studentId) {
                    this.params.student_id = this.$route.params.studentId;
                }

                if (this.$route.params.isUpdate) {
                    this.isUpdate = true;
                }

                if (this.$route.params.studentMark) {
                    this.params.id = this.$route.params.studentMark.id;
                    this.params.student_id =
                        this.$route.params.studentMark.student_id;
                    this.params.subject =
                        this.$route.params.studentMark.subject;
                    this.params.marks = this.$route.params.studentMark.marks;
                    this.params.semester =
                        this.$route.params.studentMark.semester;
                }
            },

            immediate: true,
        },
    },
    methods: {
        createOrUpdateStudentMarks() {
            this.$validator.validate().then((result) => {
                if (!result) {
                    return;
                }
                if (this.isUpdate) {
                    this.updateStudentMarks();
                    return;
                }

                this.createStudentMarks();
            });
        },

        updateStudentMarks() {
            axios
                .put("/exam", this.params)
                .then((response) => {
                    this.$router.push({ name: "exam-schedule" });
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        createStudentMarks() {
            axios
                .post("/exam", this.params)
                .then((response) => {
                    this.$router.push({ name: "exam-schedule" });
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>

<style scoped lang="scss">
.student-detail {
    .error-message {
        color: red;
    }
    .custom-btn {
        margin-top: 10px;
    }
}
</style>
