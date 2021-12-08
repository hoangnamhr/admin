<template>
    <div class="container home">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div
                            class="d-flex align-items-center justify-content-between"
                        >
                            <div>Student List</div>
                            <div
                                class="d-flex align-items-center justify-content-between"
                            >
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="searchKey"
                                    placeholder="Full Name"
                                />
                                <button
                                    class="btn btn-primary btn-sm"
                                    @click="searchItem()"
                                >
                                    Search
                                </button>
                            </div>
                        </div>
                        <div>
                            <button
                                class="btn btn-primary"
                                @click="
                                    $router.push({ name: 'student-detail' })
                                "
                            >
                                Create
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Full Name</th>
                                    <th>Class</th>
                                    <th>Phone Number</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(student, index) in students"
                                    :key="index"
                                >
                                    <td
                                        v-for="(item, index) in student"
                                        :key="index"
                                    >
                                        {{ item }}
                                    </td>
                                    <td>
                                        <button
                                            class="btn btn-primary btn-sm"
                                            @click="
                                                $router.push({
                                                    name: 'student-detail',
                                                    params: {
                                                        isUpdate: true,
                                                        student: student,
                                                    },
                                                })
                                            "
                                        >
                                            Edit
                                        </button>
                                        <button
                                            class="btn btn-primary btn-sm"
                                            @click="
                                                $router.push({
                                                    name: 'student-marks-detail',
                                                    params: {
                                                        studentId: student.id,
                                                    },
                                                })
                                            "
                                        >
                                            Create mask
                                        </button>
                                        <button
                                            class="btn btn-danger btn-sm"
                                            @click="deleteStudent(student.id)"
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
import axios from "axios";
export default {
    data() {
        return {
            students: [],
            searchKey: "",
        };
    },
    methods: {
        getStudent() {
            axios
                .get("/students")
                .then((response) => {
                    this.students = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        deleteStudent(id) {
            axios
                .delete(`/students/${id}`)
                .then((response) => {
                    this.getStudent();
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        searchItem() {
            axios
                .get(`/students`, { params: { full_name: this.searchKey } })
                .then((response) => {
                    this.students = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    mounted() {
        this.getStudent();
    },
};
</script>

<style scoped lang="scss">
.home {
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
