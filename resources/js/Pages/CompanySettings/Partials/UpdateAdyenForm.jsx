import PrimaryButton from "@/Components/PrimaryButton.jsx";
import { useForm } from "@inertiajs/react";
import InputError from "@/Components/InputError.jsx";

export default function UpdateAdyenForm({ company }) {
    const { data, setData, patch, errors } = useForm({
        adyen_merchant_account: company.adyen_merchant_account,
        adyen_api_key: company.adyen_api_key,
        adyen_client_key: company.adyen_client_key,
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        patch(route("company-settings.adyen"));
    };
    return (
        <div className="mt-6">
            <h2 className={"text-xl font-bold tracking-tight text-gray-900"}>
                Adyen settings
            </h2>
            <form onSubmit={handleSubmit}>
                <div className="grid grid-cols-1 gap-6 mt-4">
                    <div>
                        <label
                            className="text-gray-700"
                            htmlFor="adyen_merchant_account"
                        >
                            Merchant account
                        </label>
                        <input
                            id="adyen_merchant_account"
                            type="text"
                            name="adyen_merchant_account"
                            className="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-500 focus:outline-none focus:ring"
                            placeholder="Merchant account"
                            onChange={(e) => {
                                setData(
                                    "adyen_merchant_account",
                                    e.target.value
                                );
                            }}
                            value={data.adyen_merchant_account}
                        />
                        <InputError
                            message={errors.adyen_merchant_account}
                            className="mt-2"
                        />
                    </div>
                    <div>
                        <label
                            className="text-gray-700"
                            htmlFor="adyen_api_key"
                        >
                            API key
                        </label>
                        <input
                            id="adyen_api_key"
                            type="text"
                            name="adyen_api_key"
                            className="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-500 focus:outline-none focus:ring"
                            placeholder="API key"
                            onChange={(e) => {
                                setData("adyen_api_key", e.target.value);
                            }}
                            value={data.adyen_api_key}
                        />

                        <InputError
                            message={errors.adyen_api_key}
                            className="mt-2"
                        />
                    </div>
                    <div>
                        <label
                            className="text-gray-700"
                            htmlFor="adyen_client_key"
                        >
                            Client key
                        </label>
                        <input
                            id="adyen_client_key"
                            type="text"
                            name="adyen_client_key"
                            className="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-500 focus:outline-none focus:ring"
                            placeholder="Client key"
                            value={data.adyen_client_key}
                            onChange={(e) => {
                                setData("adyen_client_key", e.target.value);
                            }}
                        />

                        <InputError
                            message={errors.adyen_client_key}
                            className="mt-2"
                        />
                    </div>

                    <div>
                        <PrimaryButton className={"mt-4"}>Save</PrimaryButton>
                    </div>
                </div>
            </form>
        </div>
    );
}
