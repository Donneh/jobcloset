import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";
import EditUserForm from "@/Pages/User/Partials/EditUserForm.jsx";
export default function Edit({ auth, mustVerifyEmail, status, user, roles }) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Edit User {user.name}
                </h2>
            }
        >
            <Head title="Create User" />

            <div className="w-full">
                <div className="space-y-6 w-full">
                    <div className="p-4 sm:p-8 bg-white w-full shadow sm:rounded-lg">
                        <header>
                            <h2 className="text-lg font-medium text-gray-900">
                                Edit User
                            </h2>

                            <p className="mt-1 text-sm text-gray-600">
                                Create a new user.
                            </p>
                        </header>

                        <EditUserForm
                            mustVerifyEmail={mustVerifyEmail}
                            status={status}
                            user={user}
                            roles={roles}
                            className="max-w-xl"
                        />
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
