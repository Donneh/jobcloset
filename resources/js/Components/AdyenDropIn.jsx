// resources/js/components/AdyenDropIn.js

import React, { useEffect, useRef } from "react";
import AdyenCheckout from "@adyen/adyen-web";
import "@adyen/adyen-web/dist/adyen.css";

export default function AdyenDropIn({ sessionId, sessionData }) {
    console.log(sessionData);
    const paymentContainer = useRef(null);

    const createCheckout = async () => {
        const checkout = await AdyenCheckout({
            clientKey: "test_3DAUFMPMJJBOBKMSFWXW2T57ZA674CG3", // Load your Adyen client key from .env or config
            environment: "test", // Load your Adyen environment from .env or config
            locale: "nl-NL",
            onPaymentCompleted(data, element) {
                console.log(data, element);
            },
            onError(error, element) {
                console.error("error", error);
            },
            session: {
                id: sessionId,
                sessionData: sessionData,
            },
        });

        if (paymentContainer.current) {
            checkout.create("dropin").mount(paymentContainer.current);
        }
    };

    useEffect(() => {
        createCheckout();

        return () => {
            if (paymentContainer.current) {
                paymentContainer.current.innerHTML = "";
            }

            console.log("unmount");

            // cleanup
        };
    }, []);

    return (
        <div id="payment-container">
            <div ref={paymentContainer} className={"payment"}></div>
        </div>
    );
}
