import { Head, Link, useForm } from "@inertiajs/react";
import DeleteProductForm from "@/Pages/Product/Partials/DeleteProductForm.jsx";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.jsx";
import MainCard from "@/Components/MainCard.jsx";
import MainCardHeader from "@/Components/MainCardHeader.jsx";

export default function Index({ auth, products }) {
    return (
        <AuthenticatedLayout user={auth.user} pageTitle={"Departments"}>
            <MainCard>
                <MainCardHeader title={"Products"} />

                <div className="mt-6">
                    <Link
                        href={route("products.create")}
                        className={
                            "inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                        }
                    >
                        Create Product
                    </Link>
                </div>

                <table className="table-auto max-w-full divide-y divide-gray-300 overflow-x-auto">
                    <thead>
                        <tr>
                            <th
                                scope="col"
                                className="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0"
                            >
                                Photo
                            </th>
                            <th
                                scope="col"
                                className="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0"
                            >
                                Name
                            </th>
                            <th
                                scope="col"
                                className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                            >
                                Price
                            </th>
                            <th
                                scope="col"
                                className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                            >
                                Description
                            </th>
                            <th
                                scope="col"
                                className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                            >
                                Stock
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
                        {products.data.map((product) => (
                            <tr key={product.id}>
                                <td className="px-3 py-4 text-sm">
                                    <img
                                        className="h-16 w-16 rounded-md"
                                        src={product.image_path}
                                        alt={product.name}
                                    />
                                </td>
                                <td className="whitespace-nowrap px-3 py-4 text-sm">
                                    {product.name}
                                </td>
                                <td className="whitespace-nowrap px-3 py-4 text-sm">
                                    {product.price.currency}{" "}
                                    {product.price.amount}
                                </td>
                                <td className="px-3 py-4 text-sm">
                                    {product.description}
                                </td>
                                <td className="px-3 py-4 text-sm">
                                    {product.stock}
                                </td>
                                <td className="px-3 py-4 text-sm">
                                    <Link
                                        href={route(
                                            "products.edit",
                                            product.id
                                        )}
                                        className={
                                            "inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                        }
                                    >
                                        Edit
                                    </Link>
                                </td>
                                <td className="px-3 py-4 text-sm">
                                    <DeleteProductForm product={product} />
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            </MainCard>
        </AuthenticatedLayout>
    );
}
