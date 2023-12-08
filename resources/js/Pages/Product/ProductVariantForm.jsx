import React, { useState } from "react";
import InputLabel from "@/Components/InputLabel.jsx";
import TextInput from "@/Components/TextInput.jsx";
import InputError from "@/Components/InputError.jsx";
import PrimaryButton from "@/Components/PrimaryButton.jsx";
import SecondaryButton from "@/Components/SecondaryButton.jsx";

const ProductVariantForm = ({ onSubmit }) => {
    const [variationName, setVariationName] = useState("");
    const [options, setOptions] = useState([]);

    const handleOptionChange = (e, index) => {
        const newOptions = [...options];
        newOptions[index] = e.target.value;
        setOptions(newOptions);
    };

    const handleSubmit = (event) => {
        event.preventDefault();

        const dataToSend = { [variationName]: [...options] };

        onSubmit(dataToSend);
    };

    const addOptionName = (event) => {
        event.preventDefault();
        setOptions((prevOptionNames) => [
            ...prevOptionNames,
            `option${prevOptionNames.length + 1}`, // Changed "optionName" to "option"
        ]);
    };

    return (
        <div>
            <form className="p-6" onSubmit={handleSubmit}>
                <div>
                    <h2 className="text-lg font-medium text-gray-900">
                        Add a product variation
                    </h2>

                    <div className="mt-6">
                        <div>
                            <InputLabel htmlFor="variationName" value="Name" />
                            <TextInput
                                name="variationName"
                                value={variationName}
                                onChange={(e) =>
                                    setVariationName(e.target.value)
                                }
                                placeholder="E.g Size"
                            />
                        </div>
                        {options.map((option, index) => (
                            <div key={index}>
                                <TextInput
                                    name={option}
                                    onChange={(event) =>
                                        handleOptionChange(event, index)
                                    }
                                    placeholder="Enter option..."
                                />
                                <InputError />
                            </div>
                        ))}
                        <button onClick={addOptionName}>
                            Add more options
                        </button>
                    </div>

                    <div className="flex items-center gap-4 mt-4">
                        <PrimaryButton>Add variant</PrimaryButton>
                    </div>
                </div>
            </form>
        </div>
    );
};

export default ProductVariantForm;
