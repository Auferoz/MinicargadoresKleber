import { ActionError, defineAction } from "astro:actions";
import { z } from "astro:schema";
import { Resend } from "resend";

const resend = new Resend(import.meta.env.RESEND_API_KEY);

export const server = {
    send: defineAction({
        accept: "form",
        input: z.object({
            InputFullName: z.string().nonempty(),
            InputEmail: z.string().email(),
            InputPhone: z.string().nonempty(),
            textarea: z.string(),
        }),
        handler: async ({ InputFullName, InputEmail, InputPhone, textarea }) => {
            const { data, error } = await resend.emails.send({
                from: "Transportes Kleber <contacto@transporteskleber.cl>",
                to: ["minicargardores27@gmail.com"],
                subject: "[Transportes Kleber] Nuevo Mensaje de Contacto",
                html: `
                    <div style="max-width:600px;margin:0 auto;font-family:Arial, sans-serif;">
                        <h2 style="color:#333;text-align: center;">📩 Nuevo Mensaje de Contacto</h2>
                        <div style="margin-bottom:15px;"><strong style="color:#555;">🧑‍💼 Nombre:</strong> ${InputFullName} </div>
                        <div style="margin-bottom:15px;"><strong style="color:#555;">📞 Teléfono:</strong> ${InputPhone} </div>
                        <div style="margin-bottom:15px;"><strong style="color:#555;">✉️ Email:</strong> ${InputEmail} </div>
                        <div style="margin-bottom:15px;"><strong style="color:#555;">📝 Mensaje:</strong></div>
                        <div class="message" style="background:#f9f9f9;padding:10px;border-left:4px solid #007bff;margin-top:10px;font-style:italic;">
                            ${textarea}
                        </div>
                    </div>
                `,
            });

            if (error) {
                throw new ActionError({
                    code: "BAD_REQUEST",
                    message: error.message,
                });
            }

            return data;
        },
    }),
};
