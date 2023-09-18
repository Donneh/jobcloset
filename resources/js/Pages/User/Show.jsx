import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link, router, useForm } from "@inertiajs/react";
import SecondaryButton from "@/Components/SecondaryButton.jsx";
import RemoveFromDepartmentForm from "@/Pages/User/Partials/RemoveFromDepartmentForm.jsx";
import RemoveFromJobTitleForm from "@/Pages/User/Partials/RemoveFromJobTitleForm.jsx";
import RemoveFromLocationForm from "@/Pages/User/Partials/RemoveFromLocationForm.jsx";

export default function Show(user) {
    const { post } = useForm({
        _method: "DELETE",
        userId: user.id,
        department: null,
    });

    const removeFromDepartment = (e) => {
        e.preventDefault();

        console.log(e);
    };
    return (
        <AuthenticatedLayout>
            <Head title="User details" />

            <div className="space-y-6 w-full">
                <div className="p-4 sm:p-8 bg-white w-full shadow sm:rounded-lg">
                    <header>
                        <h2 className="text-lg font-medium text-gray-900">
                            {user.user.name}
                        </h2>

                        <p className="mt-1 text-sm text-gray-600">
                            User details.
                        </p>
                    </header>

                    <div className="mt-6">
                        <Link
                            href={route("users.edit", user)}
                            className={
                                "inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                            }
                        >
                            Edit User
                        </Link>
                    </div>

                    <div className="mt-6">
                        <h3 className={"font-bold"}>Current locations</h3>

                        <ul>
                            {user.user.locations.map((location) => (
                                <li
                                    key={location.name}
                                    className={
                                        "flex justify-between items-center"
                                    }
                                >
                                    <Link
                                        href={route(
                                            "locations.show",
                                            location.id
                                        )}
                                    >
                                        {location.name}
                                    </Link>
                                    <RemoveFromLocationForm
                                        location={location}
                                        user={user}
                                    />
                                </li>
                            ))}
                        </ul>
                    </div>

                    <div className="mt-6">
                        <h3 className={"font-bold"}>Current departments</h3>

                        <ul>
                            {user.user.departments.map((department) => (
                                <li
                                    key={department.name}
                                    className={
                                        "flex justify-between items-center"
                                    }
                                >
                                    <Link
                                        href={route(
                                            "departments.show",
                                            department.id
                                        )}
                                    >
                                        {department.name}
                                    </Link>

                                    <RemoveFromDepartmentForm
                                        user={user}
                                        department={department}
                                    />
                                </li>
                            ))}
                        </ul>
                    </div>

                    <div className="mt-6">
                        <h3 className={"font-bold"}>Current job titles</h3>

                        <ul>
                            {user.user.jobTitles.map((jobTitle) => (
                                <li
                                    key={jobTitle.name}
                                    className={
                                        "flex justify-between items-center"
                                    }
                                >
                                    <Link
                                        href={route(
                                            "job-titles.show",
                                            jobTitle.id
                                        )}
                                    >
                                        {jobTitle.name}
                                    </Link>
                                    <RemoveFromJobTitleForm
                                        user={user}
                                        jobTitle={jobTitle}
                                    />
                                </li>
                            ))}
                        </ul>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
