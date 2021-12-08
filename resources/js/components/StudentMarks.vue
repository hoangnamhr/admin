<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div>Student List</div>
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
    },
    mounted() {
        this.getStudentMarks();
    },
};
</script>
