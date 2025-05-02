import React, { useState, useEffect } from 'react';
import {
  View, Text, StyleSheet, FlatList, Modal, TextInput, Button, Alert,
} from 'react-native';
import axios from 'axios';
import { Picker } from '@react-native-picker/picker';
import API_URL from '../API/config';

const JornadasScreen = () => {
  const [jornadas, setJornadas] = useState([]);
  const [modalVisible, setModalVisible] = useState(false);
  const [modalUpdateVisible, setModalUpdateVisible] = useState(false);
  const [modalDeleteVisible, setModalDeleteVisible] = useState(false);
  const [newJornada, setNewJornada] = useState({ jornada: 'Mañana', hora_inicio: '', hora_final: '' });
  const [selectedJornada, setSelectedJornada] = useState(null);

  useEffect(() => {
    fetchJornadas();
  }, []);

  const fetchJornadas = async () => {
    try {
      const response = await axios.get(API_URL, {
        params: { action: 'obtenerJornada' },
      });

      console.log(response.data);
      if (response.data.status === 'success') {
        setJornadas(response.data.data); 
      } else {
        Alert.alert('Error', response.data.message || 'Error al cargar las jornadas.');
      }
    } catch (error) {
      console.error('Error fetching jornadas:', error);
      Alert.alert('Error', 'Failed to load jornadas.');
    }
  };

  const createJornada = async () => {
    try {
      await axios.post(API_URL, {
        action: 'crearJornada',
        ...newJornada,
      });
      setModalVisible(false);
      fetchJornadas();
      Alert.alert('Éxito', 'Jornada creada correctamente.');
    } catch (error) {
      console.error('Error creating jornada:', error);
      Alert.alert('Error', 'No se pudo crear la jornada.');
    }
  };

  const updateJornada = async () => {
    try {
      await axios.post(API_URL, {
        action: 'actualizarJornada',
        ...selectedJornada,
      });
      setModalUpdateVisible(false);
      fetchJornadas();
      Alert.alert('Éxito', 'Jornada actualizada correctamente.');
    } catch (error) {
      console.error('Error updating jornada:', error);
      Alert.alert('Error', 'No se pudo actualizar la jornada.');
    }
  };
  

  const deleteJornada = async () => {
    try {
      const response = await axios.post(API_URL, {
        action: 'eliminarjornada',
        id_jornada: selectedJornada.id_jornada,
      });
      console.log(response.data);
      setModalDeleteVisible(false);
      fetchJornadas();
      Alert.alert('Éxito', 'Jornada eliminada correctamente.');
    } catch (error) {
      console.error('Error deleting jornada:', error);
      Alert.alert('Error', 'No se pudo eliminar la jornada.');
    }
  };
  
  
  

  const renderJornadaItem = ({ item }) => (
    <View style={styles.card}>
      <Text style={styles.cardTitle}>{item.jornada}</Text>
      <Text>Hora Inicio: {item.hora_inicio}</Text>
      <Text>Hora Final: {item.hora_final}</Text>
      <View style={styles.buttonContainer}>
        <Button title="Actualizar" onPress={() => { setSelectedJornada(item); setModalUpdateVisible(true); }} color="#007bff" />
        <Button title="Eliminar" onPress={() => { setSelectedJornada(item); setModalDeleteVisible(true); }} color="red" />
      </View>
    </View>
  );

  const renderModalCrear = () => (
    <Modal visible={modalVisible} animationType="slide">
      <View style={styles.modalView}>
        <Text style={styles.modalTitle}>Crear Jornada</Text>
        <Picker
          selectedValue={newJornada.jornada}
          onValueChange={(itemValue) => setNewJornada({ ...newJornada, jornada: itemValue })}
          style={styles.picker}
        >
          <Picker.Item label="Mañana" value="Mañana" />
          <Picker.Item label="Tarde" value="Tarde" />
          <Picker.Item label="Noche" value="Noche" />
          <Picker.Item label="Unica" value="Unica" />
        </Picker>
        <TextInput
          style={styles.input}
          placeholder="Hora Inicio (HH:MM)"
          value={newJornada.hora_inicio}
          onChangeText={(text) => setNewJornada({ ...newJornada, hora_inicio: text })}
        />
        <TextInput
          style={styles.input}
          placeholder="Hora Final (HH:MM)"
          value={newJornada.hora_final}
          onChangeText={(text) => setNewJornada({ ...newJornada, hora_final: text })}
        />
        <Button title="Crear" onPress={createJornada} color="#28a745" />
        <Button title="Cancelar" onPress={() => setModalVisible(false)} color="gray" />
      </View>
    </Modal>
  );

  const renderModalActualizar = () => (
    <Modal visible={modalUpdateVisible} animationType="slide">
      <View style={styles.modalView}>
        <Text style={styles.modalTitle}>Actualizar Jornada</Text>
        <Picker
          selectedValue={selectedJornada?.jornada}
          onValueChange={(itemValue) => setSelectedJornada({ ...selectedJornada, jornada: itemValue })}
          style={styles.picker}
        >
          <Picker.Item label="Mañana" value="Mañana" />
          <Picker.Item label="Tarde" value="Tarde" />
          <Picker.Item label="Noche" value="Noche" />
          <Picker.Item label="Unica" value="Unica" />
        </Picker>
        <TextInput
          style={styles.input}
          placeholder="Hora Inicio (HH:MM)"
          value={selectedJornada?.hora_inicio}
          onChangeText={(text) => setSelectedJornada({ ...selectedJornada, hora_inicio: text })}
        />
        <TextInput
          style={styles.input}
          placeholder="Hora Final (HH:MM)"
          value={selectedJornada?.hora_final}
          onChangeText={(text) => setSelectedJornada({ ...selectedJornada, hora_final: text })}
        />
        <Button title="Actualizar" onPress={updateJornada} color="#28a745" />
        <Button title="Cancelar" onPress={() => setModalUpdateVisible(false)} color="gray" />
      </View>
    </Modal>
  );

  const renderModalEliminar = () => (
    <Modal visible={modalDeleteVisible} animationType="slide">
      <View style={styles.modalView}>
        <Text style={styles.modalTitle}>Confirmar Eliminación</Text>
        <Text>¿Estás seguro de que deseas eliminar esta jornada?</Text>
        <Button title="Eliminar" onPress={deleteJornada} color="red" />
        <Button title="Cancelar" onPress={() => setModalDeleteVisible(false)} color="gray" />
      </View>
    </Modal>
  );

  return (
    <View style={styles.container}>
      <Text style={styles.title}>Gestión de Jornadas</Text>
      <FlatList
        data={jornadas}
        renderItem={renderJornadaItem}
        keyExtractor={(item, index) => item.id_jornada?.toString() || `jornada_${index}`}
      />
      <View style={styles.buttonWrapper}>
        <Button title="Crear Jornada" onPress={() => setModalVisible(true)} color="#007bff" />
      </View>
      {renderModalCrear()}
      {renderModalActualizar()}
      {renderModalEliminar()}
    </View>
  );
};

const styles = StyleSheet.create({
  container: { flex: 1, padding: 20, backgroundColor: '#f0f0f0' },
  title: {
    fontSize: 24,
    fontWeight: 'bold',
    marginBottom: 20,
    marginTop: 50,
    textAlign: 'center',
    color: '#333',
  },
  card: {
    backgroundColor: '#fff',
    padding: 20,
    marginVertical: 8,
    borderRadius: 10,
    shadowColor: '#000',
    shadowOffset: { width: 0, height: 2 },
    shadowOpacity: 0.25,
    shadowRadius: 3.84,
    elevation: 5,
  },
  cardTitle: {
    fontSize: 18,
    fontWeight: 'bold',
    marginBottom: 10,
    color: '#007bff',
  },
  buttonContainer: {
    flexDirection: 'row',
    justifyContent: 'space-around',
    marginTop: 10,
  },
  modalView: {
    margin: 20,
    backgroundColor: '#fff',
    borderRadius: 20,
    padding: 35,
    alignItems: 'center',
    shadowColor: '#000',
    shadowOffset: { width: 0, height: 2 },
    shadowOpacity: 0.25,
    shadowRadius: 4,
    elevation: 5,
  },
  modalTitle: {
    fontSize: 20,
    fontWeight: 'bold',
    marginBottom: 15,
    textAlign: 'center',
    color: '#333',
  },
  input: {
    height: 40,
    margin: 12,
    borderWidth: 1,
    padding: 10,
    borderRadius: 8,
    width: '100%',
    backgroundColor: '#f9f9f9',
  },
  picker: {
    height: 50,
    width: '100%',
    marginBottom: 15,
    borderRadius: 8,
    backgroundColor: '#f9f9f9',
  },
  buttonWrapper: {
    marginTop: 20,
    marginBottom: 60,
  },
});

export default JornadasScreen;
