import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";
import CreateDepartmentForm from "@/Pages/Department/Partials/CreateDepartmentForm.jsx";
import DeleteDepartmentForm from "@/Pages/Department/Partials/DeleteDepartmentForm.jsx";
import AddUserToDepartmentForm from "@/Pages/Department/Partials/AddUserToDepartmentForm.jsx";

export default function Show({ auth, department, users }) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Create Department
                </h2>
            }
        >
            <Head title="Create Department" />

            <div className="w-full">
                <div className="space-y-6 w-full">
                    <div className="p-4 sm:p-8 bg-white w-full shadow sm:rounded-lg">
                        <header>
                            <h2 className="text-lg font-medium text-gray-900">
                                {department.name}
                            </h2>

                            <p className="mt-1 text-sm text-gray-600">
                                Department details.
                            </p>
                        </header>

                        <div className="mt-6">
                            <Link
                                href={route("department.edit", department.id)}
                                className={
                                    "inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                }
                            >
                                Edit Department
                            </Link>
                        </div>

                        <div className="mt-6">
                            <h3 className={"font-bold"}>Add user</h3>

                            <div className="my-3">
                                <hr />
                                <AddUserToDepartmentForm
                                    users={users}
                                    department={department}
                                />
                                <hr className={"mt-3"} />
                            </div>
                        </div>

                        <div className="mt-6">
                            <h3 className={"font-bold"}>Current users</h3>
                        </div>
                        <table className="table-auto max-w-full divide-y divide-gray-300 overflow-x-auto">
                            <thead>
                                <tr>
                                    <th
                                        scope="col"
                                        className="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0"
                                    >
                                        Name
                                    </th>
                                </tr>
                            </thead>
                            <tbody className="divide-y divide-gray-200">
                                {department.users.map((user) => (
                                    <tr key={user.id}>
                                        <td className="px-3 py-4 text-sm">
                                            {user.name}
                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
