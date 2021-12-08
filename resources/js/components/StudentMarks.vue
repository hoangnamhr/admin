<template>
    <div class="container student_marks">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <div>Student Mark</div>
                        <div
                            class="d-flex align-items-center justify-content-between"
                        >
                            <input
                                type="text"
                                class="form-control"
                                v-model="searchKey"
                                placeholder="Student Id"
                            />
                            <button
                                class="btn btn-primary btn-sm"
                                @click="searchItem()"
                            >
                                Search
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Student Id</th>
                                    <th>Subject</th>
                                    <th>Marks</th>
                                    <th>Semester</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(studentMark, index) in studentMarks"
                                    :key="index"
                                >
                                    <td
                                        v-for="(item, index) in studentMark"
                                        :key="index"
                                    >
                                        {{ item }}
                                    </td>
                                    <td>
                                        <button
                                            class="btn btn-primary btn-sm"
                                            @click="
                                                $router.push({
                                                    name: 'student-marks-detail',
                                                    params: {
                                                        isUpdate: true,
                                                        studentMark:
                                                            studentMark,
                                                    },
                                                })
                                            "
                                        >
                                            Edit
                                        </button>
                                        <button
                                            class="btn btn-danger btn-sm"
                                            @click="
                                                deleteStudentMarks(
                                                    studentMark.id
                                                )
                                            "
                                        >
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
            studentMarks: [],
            searchKey: "",
        };
    },
    methods: {
        getStudentMarks() {
            axios
                .get("/student-mark")
                .then((response) => {
                    this.studentMarks = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        deleteStudentMarks(id) {
            axios
                .delete(`/student-mark/${id}`)
                .then((response) => {
                    this.getStudentMarks();
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        searchItem() {
            axios
                .get(`/student-mark`, {
                    params: { student_id: this.searchKey },
                })
                .then((response) => {
                    this.studentMarks = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    mounted() {
        this.getStudentMarks();
    },
};
</script>

<style scoped lang="scss">
.student_marks {
    .card-header {
        div {
            margin: 0px 10px;
        }
        button {
            margin-left: 10px;
        }
    }
}
</style>
