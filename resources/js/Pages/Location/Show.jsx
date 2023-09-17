import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link, useForm } from "@inertiajs/react";
import AddUserToLocationForm from "@/Pages/Location/Partials/AddUserToLocationForm.jsx";
import PrimaryButton from "@/Components/PrimaryButton.jsx";

export default function Show({ auth, location, users }) {
    const {
        data,
        setData,
        errors,
        reset,
        processing,
        progress,
        delete: destroy,
    } = useForm({
        user_id: "",
    });
    const removeUserFromLocation = (e) => {
        e.preventDefault();
        data.user_id = e.target.user_id.value;
        destroy(route("locations.removeUser", location), {
            preserveScroll: true,
            onSuccess: () => reset(),
            onError: (errors) => {
                Object.keys(errors).forEach((key) => {
                    reset(key);
                });
            },
        });
    };
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Create Location
                </h2>
            }
        >
            <Head title="Create Location" />

            <div className="w-full">
                <div className="space-y-6 w-full">
                    <div className="p-4 sm:p-8 bg-white w-full shadow sm:rounded-lg">
                        <header>
                            <h2 className="text-lg font-medium text-gray-900">
                                {location.name}
                            </h2>

                            <p className="mt-1 text-sm text-gray-600">
                                Location details.
                            </p>
                        </header>

                        <div className="mt-6">
                            <Link
                                href={route("locations.edit", location.id)}
                                className={
                                    "inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                }
                            >
                                Edit Location
                            </Link>
                        </div>

                        <div className="mt-6">
                            <h3 className={"font-bold"}>Add user</h3>

                            <div className="my-3">
                                <hr />
                                <AddUserToLocationForm
                                    users={users}
                                    location={location}
                                />
                                <hr className={"mt-3"} />
                            </div>
                        </div>

                        <div className="mt-6">
                            <h3 className={"font-bold"}>Current users</h3>
                        </div>
                        <ul>
                            {location.users.map((user) => (
                                <li
                                    key={user.email}
                                    className="flex justify-between gap-x-6 py-5"
                                >
                                    <div className="flex min-w-0 gap-x-4">
                                        <div className="h-12 w-12 flex-none rounded-full bg-emerald-200 flex items-center justify-center">
                                            {user.name[0]}
                                        </div>
                                        <div className="min-w-0 flex-auto">
                                            <p className="text-sm font-semibold leading-6 text-gray-900">
                                                <a
                                                    href={user.href}
                                                    className="hover:underline"
                                                >
                                                    {user.name}
                                                </a>
                                            </p>
                                            <p className="mt-1 flex text-xs leading-5 text-gray-500">
                                                <a
                                                    href={`mailto:${user.email}`}
                                                    className="truncate hover:underline"
                                                >
                                                    {user.email}
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                    <div className="flex shrink-0 items-center gap-x-6">
                                        <div className="hidden sm:flex sm:flex-col sm:items-end">
                                            <form
                                                onSubmit={
                                                    removeUserFromLocation
                                                }
                                            >
                                                <input
                                                    type={"hidden"}
                                                    name={"user_id"}
                                                    value={user.id}
                                                />
                                                <PrimaryButton type={"submit"}>
                                                    Remove from location
                                                </PrimaryButton>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            ))}
                        </ul>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
