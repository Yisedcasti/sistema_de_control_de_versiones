import React, { useEffect, useState } from 'react';
import { View, Text, StyleSheet, ActivityIndicator } from 'react-native';
import axios from 'axios';  // Importar axios
import API_URL from '../API/config';

const NoticiasSection = () => {
    const [noticias, setNoticias] = useState([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        const fetchNoticias = async () => {
            try {
                const response = await axios.get(API_URL, {
                    params: { action: "obtenerNoticias" },
                });

                console.log('Respuesta de la API:', response.data);

                if (Array.isArray(response.data.noticias)) {
                    setNoticias(response.data.noticias);
                } else {
                    console.error('La respuesta no es un arreglo:', response.data);
                    setNoticias([]); 
                }
            } catch (error) {
                console.error('Error al obtener noticias:', error);
                setNoticias([]); 
            } finally {
                setLoading(false);
            }
        };

        fetchNoticias();
    }, []);

    return (
        <View style={styles.section}>
            <Text style={styles.subtitle}>Noticias</Text>
            {loading ? (
                <ActivityIndicator size="large" color="#007bff" />
            ) : (
                noticias.length > 0 ? (
                    noticias.map((noticia) => (
                        <View key={noticia.id_noticia} style={styles.card}>
                            <Text style={styles.title}>{noticia.titulo}</Text>
                            <Text style={styles.text}>{noticia.info}</Text>
                            <Text style={styles.text}>
                                Atentamente: {noticia.registro_num_doc}
                            </Text>
                        </View>
                    ))
                ) : (
                    <Text>No hay noticias disponibles.</Text>
                )
            )}
        </View>
    );
};

const styles = StyleSheet.create({
    section: {
        padding: 16,
        backgroundColor: '#f8f9fa',
    },
    subtitle: {
        fontSize: 22,
        fontWeight: 'bold',
        color: '#212529',
        marginBottom: 12,
    },
    card: {
        backgroundColor: '#ffffff',
        borderRadius: 12,
        padding: 16,
        marginBottom: 12,
        shadowColor: '#000',
        shadowOffset: { width: 0, height: 2 },
        shadowOpacity: 0.1,
        shadowRadius: 4,
        elevation: 3,
    },
    title: {
        fontSize: 18,
        fontWeight: '600',
        marginBottom: 6,
        color: '#333',
    },
    text: {
        fontSize: 14,
        color: '#555',
    },
});

export default NoticiasSection;
