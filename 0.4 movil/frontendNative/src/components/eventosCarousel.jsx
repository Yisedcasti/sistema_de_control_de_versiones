import React, { useEffect, useState } from 'react';
import { FlatList, View, Text, Image, Dimensions, StyleSheet } from 'react-native';
import axios from 'axios';
import API_URL from '../API/config';

const { width: screenWidth } = Dimensions.get('window');

const EventosCarousel = ({ apiUrl }) => {
    const [eventos, setEventos] = useState([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        const fetchEventos = async () => {
            try {
                const response = await axios(API_URL, {
                    params: { action: 'obtenerEvento' },
                });
                const { data } = response.data;  // Acceder correctamente a la propiedad 'data'
                console.log(data);
                if (Array.isArray(data)) {
                    setEventos(data);
                } else {
                    console.warn('La respuesta no es un array:', data);
                }
            } catch (error) {
                console.error('Error al obtener eventos:', error);
            } finally {
                setLoading(false);
            }
        };
    }, [apiUrl]);

    const renderItem = ({ item }) => (
        <View style={styles.card}>
            <Image source={{ uri: item.img }} style={styles.image} />
            <View style={styles.caption}>
                <Text style={styles.title}>{item.evento}</Text>
                <Text style={styles.date}>{item.fecha_evento}</Text>
                <Text style={styles.name}>{item.registr_num_doc}</Text>
            </View>
        </View>
    );

    if (loading) {
        return (
            <View style={styles.messageContainer}>
                <Text style={styles.message}>Cargando eventos...</Text>
            </View>
        );
    }

    if (!loading && eventos.length === 0) {
        return (
            <View style={styles.messageContainer}>
                <Text style={styles.message}>No hay eventos disponibles.</Text>
            </View>
        );
    }

    return (
        <FlatList
            data={eventos}
            renderItem={renderItem}
            keyExtractor={(_, index) => index.toString()}
            horizontal
            pagingEnabled
            showsHorizontalScrollIndicator={false}
        />
    );
};

const styles = StyleSheet.create({
    card: {
        width: screenWidth * 0.8,
        marginHorizontal: screenWidth * 0.05,
        borderRadius: 16,
        backgroundColor: '#ffffff',
        overflow: 'hidden',
        shadowColor: '#000',
        shadowOffset: { width: 0, height: 4 },
        shadowOpacity: 0.1,
        shadowRadius: 6,
        elevation: 5,
    },
    image: {
        width: '100%',
        height: 200,
        resizeMode: 'cover',
    },
    caption: {
        backgroundColor: '#f8f9fa',
        paddingVertical: 12,
        paddingHorizontal: 16,
    },
    title: {
        fontSize: 18,
        fontWeight: 'bold',
        color: '#212529',
        marginBottom: 4,
    },
    date: {
        fontSize: 14,
        color: '#6c757d',
        marginBottom: 2,
    },
    name: {
        fontSize: 14,
        color: '#495057',
    },
    messageContainer: {
        padding: 20,
        alignItems: 'center',
        justifyContent: 'center',
    },
    message: {
        fontSize: 16,
        color: '#666',
    },
});

export default EventosCarousel;
