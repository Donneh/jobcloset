import { Head, Link, useForm } from "@inertiajs/react";
import DeleteProductForm from "@/Pages/Product/Partials/DeleteProductForm.jsx";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.jsx";
import DeleteUserForm from "@/Pages/User/Partials/DeleteUserForm.jsx";
import MainCardHeader from "@/Components/MainCardHeader.jsx";
import MainCard from "@/Components/MainCard.jsx";

export default function Index({ auth, users }) {
    return (
        <AuthenticatedLayout user={auth.user} pageTitle={"Users"}>
            <MainCard>
                <MainCardHeader title={"Users"} />

                <div className="mt-6">
                    <Link
                        href={route("users.create")}
                        className={
                            "inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                        }
                    >
                        Create user
                    </Link>
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
                            <th
                                scope="col"
                                className="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0"
                            >
                                Email
                            </th>
                            <th
                                scope="col"
                                className="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0"
                            >
                                Role
                            </th>
                            <th
                                scope="col"
                                className="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0"
                            >
                                Departments
                            </th>
                            <th
                                scope="col"
                                className="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0"
                            >
                                Job Titles
                            </th>
                            <th
                                scope="col"
                                className="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0"
                            >
                                Locations
                            </th>
                            <th
                                scope="col"
                                className="relative py-3.5 pl-3 pr-4 sm:pr-0"
                            >
                                <span className="sr-only">Edit</span>
                            </th>
                            <th
                                scope="col"
                                className="relative py-3.5 pl-3 pr-4 sm:pr-0"
                            >
                                <span className="sr-only">Delete</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody className="divide-y divide-gray-200">
                        {users.map((user) => (
                            <tr key={user.id}>
                                <td className="px-3 py-4 text-sm">
                                    <Link
                                        href={route("users.show", user.id)}
                                        className={"underline"}
                                    >
                                        {user.name}
                                    </Link>
                                </td>
                                <td className="whitespace-nowrap px-3 py-4 text-sm">
                                    {user.email}
                                </td>
                                <td className="whitespace-nowrap px-3 py-4 text-sm">
                                    {user.role}
                                </td>
                                <td className="whitespace-nowrap px-3 py-4 text-sm">
                                    {user.departments.map((department) => (
                                        <span
                                            key={department.id}
                                            className="inline-flex items-center px-2 py-1 border-1 border rounded text-s font-medium bg-gray-100 text-gray-800 mr-1"
                                        >
                                            {department.name}
                                        </span>
                                    ))}
                                </td>
                                <td className="whitespace-nowrap px-3 py-4 text-sm">
                                    {user.job_titles.map((job_title) => (
                                        <span
                                            key={job_title.id}
                                            className="inline-flex items-center px-2 py-1 border-1 border rounded text-s font-medium bg-gray-100 text-gray-800 mr-1"
                                        >
                                            {job_title.name}
                                        </span>
                                    ))}
                                </td>
                                <td className="whitespace-nowrap px-3 py-4 text-sm">
                                    {user.locations.map((location) => (
                                        <span
                                            key={location.id}
                                            className="inline-flex items-center px-2 py-1 border-1 border rounded text-s font-medium bg-gray-100 text-gray-800 mr-1"
                                        >
                                            {location.name}
                                        </span>
                                    ))}
                                </td>

                                <td className="px-3 py-4 text-sm">
                                    <Link
                                        href={route("users.edit", user.id)}
                                        className={
                                            "inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                        }
                                    >
                                        Edit
                                    </Link>
                                </td>
                                <td className="px-3 py-4 text-sm">
                                    <DeleteUserForm user={user} />
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            </MainCard>
        </AuthenticatedLayout>
    );
}
